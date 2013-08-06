#!/usr/bin/ruby

require "couchdb"
require "mongo"
require "redis"

DEFAULT_VALUE = "bobo"
error = false
begin
	database_option = ARGV[0]
	host = ARGV[1]
	wordfile = ARGV[2]
	valueforeachkey = ARGV[3]
	if host.nil? || wordfile.nil?
		puts "usage: pollute-nosql.rb couchdb|mongo|redis host wordfile [value_for_each_key]"
		error = true
	else
		infile = File.open(wordfile, "r")
		case database_option
		when "couchdb"
			server = CouchDB::Server.new(host, 5984)
			while (word = infile.gets)
				word = word.strip.downcase
				# Database names in CouchDB must:
				# 1. Start with a letter
				# 2. Be in lowercase
				# 3. Cannot have special characters. Only [a-z0-9] are allowed
				if (!(word =~ /^[a-z][a-z0-9_$()+-\/]*$/).nil?)
					db = CouchDB::Database.new(server, word)
					db.create_if_missing!
					if valueforeachkey.nil?
						doc = CouchDB::Document.new(db, "#{DEFAULT_VALUE}" => 1)
						doc.save
					else
						doc = CouchDB::Document.new(db, "#{valueforeachkey}" => 1)
						doc.save
					end
				end
			end
		when "mongo"
			client = Mongo::Connection.new(host, 27017)
			while (word = infile.gets)
				db = client[word.strip]
				collection = db['test']
				if valueforeachkey.nil?
					collection.insert({DEFAULT_VALUE => 1})
				else
					collection.insert({valueforeachkey => 1})
				end
			end
		when "redis"
			redis = Redis.new(:host => host, :port => 6379)
			while (word = infile.gets)
				if valueforeachkey.nil?
					redis.set(word.strip, DEFAULT_VALUE)
				else
					redis.set(word.strip, valueforeachkey)
				end
			end
		else
			puts "Unknown database option"
			error = true
		end
		infile.close
	end
rescue Exception => e
	puts "pollute: " + e.message
	error = true
ensure
	if !error
		puts "Done!"
	end
end
