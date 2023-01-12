# MySQL-Front Dump 2.5
#
# Host: localhost   Database: d_site
# --------------------------------------------------------
# Server version 4.0.18-nt


#
# Drop old unused Tables
#

DROP TABLE IF EXISTS ibf_cms_comments;
DROP TABLE IF EXISTS ibf_cms_log;
DROP TABLE IF EXISTS ibf_cms_log_actions;
DROP TABLE IF EXISTS ibf_cms_permissions;
DROP TABLE IF EXISTS ibf_cms_user_group;
DROP TABLE IF EXISTS ibf_cms_users;


#
# Table structure for table 'ibf_cms_content'
#
DROP TABLE IF EXISTS ibf_cms_content;

CREATE TABLE ibf_cms_content (
  id int(8) unsigned NOT NULL auto_increment,
  path varchar(255) NOT NULL default '',
  rights varchar(16) NOT NULL default '000000000',
  owner int(8) unsigned NOT NULL default '0',
  ogroup int(8) unsigned NOT NULL default '0',
  description text,
  UNIQUE KEY path (path),
  KEY id (id)
) TYPE=MyISAM;



#
# Table structure for table 'ibf_cms_groups'
#
DROP TABLE IF EXISTS ibf_cms_groups;

CREATE TABLE ibf_cms_groups (
  id int(8) unsigned NOT NULL auto_increment,
  users varchar(255) NOT NULL default '',
  home varchar(255) NOT NULL default '',
  name varchar(15) NOT NULL default '',
  description text NOT NULL,
  mid int(8) unsigned NOT NULL default '0',
  KEY id (id)
) TYPE=MyISAM;



#
# Table structure for table 'ibf_cms_moderators'
#
DROP TABLE IF EXISTS ibf_cms_moderators;

CREATE TABLE ibf_cms_moderators (
  mid mediumint(8) NOT NULL auto_increment,
  forum_id int(5) NOT NULL default '0',
  member_name varchar(32) NOT NULL default '',
  member_id mediumint(8) NOT NULL default '0',
  edit_post tinyint(1) default NULL,
  delete_post tinyint(1) default NULL,
  approve_post tinyint(1) default NULL,
  is_group smallint(3) default NULL,
  PRIMARY KEY  (mid),
  KEY forum_id (forum_id),
  KEY group_id (is_group),
  KEY member_id (member_id)
) TYPE=MyISAM;



#
# Table structure for table 'ibf_cms_uploads'
#
DROP TABLE IF EXISTS ibf_cms_uploads;

CREATE TABLE ibf_cms_uploads (
  id int(11) unsigned NOT NULL auto_increment,
  name varchar(63) NOT NULL default '',
  short_desc varchar(255) NOT NULL default '',
  article text NOT NULL,
  hits int(11) NOT NULL default '0',
  user_id int(11) NOT NULL default '0',
  author_name varchar(255) NOT NULL default '',
  submit_date int(11) NOT NULL default '0',
  icon_id int(11) NOT NULL default '0',
  approved int(11) unsigned default NULL,
  article_id varchar(63) NOT NULL default '',
  UNIQUE KEY id (id)
) TYPE=MyISAM;



#
# Table structure for table 'ibf_cms_uploads_cat'
#
DROP TABLE IF EXISTS ibf_cms_uploads_cat;

CREATE TABLE ibf_cms_uploads_cat (
  id int(10) unsigned NOT NULL auto_increment,
  parent_id int(10) unsigned NOT NULL default '0',
  name varchar(255) NOT NULL default '',
  category_id varchar(63) NOT NULL default '',
  description text NOT NULL,
  num int(11) NOT NULL default '0',
  always_empty tinyint(1) unsigned NOT NULL default '0',
  UNIQUE KEY id (id)
) TYPE=MyISAM;



#
# Table structure for table 'ibf_cms_uploads_cat_links'
#
DROP TABLE IF EXISTS ibf_cms_uploads_cat_links;

CREATE TABLE ibf_cms_uploads_cat_links (
  base int(11) NOT NULL default '0',
  refs int(11) NOT NULL default '0'
) TYPE=MyISAM;



#
# Table structure for table 'ibf_cms_uploads_file_links'
#
DROP TABLE IF EXISTS ibf_cms_uploads_file_links;

CREATE TABLE ibf_cms_uploads_file_links (
  base int(11) NOT NULL default '0',
  refs int(11) NOT NULL default '0'
) TYPE=MyISAM;



#
# Table structure for table 'ibf_cms_uploads_files'
#
DROP TABLE IF EXISTS ibf_cms_uploads_files;

CREATE TABLE ibf_cms_uploads_files (
  id int(10) unsigned NOT NULL auto_increment,
  name varchar(63) NOT NULL default '',
  path varchar(255) NOT NULL default '',
  mime varchar(63) NOT NULL default '',
  hits int(11) NOT NULL default '0',
  KEY id (id)
) TYPE=MyISAM;
