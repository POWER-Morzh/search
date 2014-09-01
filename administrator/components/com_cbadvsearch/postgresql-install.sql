DROP TABLE IF EXISTS "#__cbadvsearch";

CREATE TABLE "#__cbadvsearch" (
  "id" serial NOT NULL,
  "field_id" varchar(50) null default null,
  "label" varchar(50) null default null,
  "published" tinyint NOT NULL default '1',
  "searchable" tinyint NOT NULL default '1',
  "appears_results" tinyint NOT NULL DEFAULT '1',
  "ordering" integer NOT NULL,
  "description" varchar(250) NULL default NULL,
  "thesearch" smallint NOT NULL DEFAULT '1',
  "comparison_sign" char(5) NULL DEFAULT '=',
  "fill_in_text" varchar(20) NULL DEFAULT '',
  "css_class" varchar(20) NULL DEFAULT null,
  PRIMARY KEY  ("id")
);

DROP TABLE IF EXISTS "#__cbadvsearchsdesc";

CREATE TABLE "#__cbadvsearchsdesc" (
  "id" serial NOT NULL,
  "description" varchar(250) NULL default NULL,
  "listing" tinyint not NULL default '0',
  "searches" smallint NOT NULL DEFAULT '1',
  "empty_fields" tinyint not NULL default '1',
  "order_by" varchar(50) not NULL default 'id asc',
  "show_order_by" tinyint not NULL default '1',
  "show_avatar" tinyint not NULL default '1',
  "show_numbers" tinyint not NULL default '1',
  "user_groups" varchar(250) NULL default NULL,
  "show_the_searchfield" tinyint not NULL default '1',
  "search_by_fields_or_cblists" tinyint not NULL default '0',
  "cblist_id" integer not NULL default '0',
  PRIMARY KEY  ("id")
);

DROP TABLE IF EXISTS "#__cbadvsearchconfig";

CREATE TABLE "#__cbadvsearchconfig" (
  "id" serial NOT NULL,
  "language" char(10) DEFAULT NULL,
  PRIMARY KEY ("id")
);
CREATE INDEX "#__cbadvsearchconfig_idx_language" ON "#__cbadvsearchconfig" ("language");

DROP TABLE IF EXISTS "#__cbadvsearchlanguages";

CREATE TABLE if not exists "#__cbadvsearchlanguages" (
  "id" serial NOT NULL,
  "name" varchar(100) NOT NULL DEFAULT '',
  "active" tinyint NOT NULL DEFAULT '0',
  "iso" varchar(20) DEFAULT NULL,
  "code" varchar(20) NOT NULL DEFAULT '',
  "shortcode" varchar(20) DEFAULT NULL,
  "image" varchar(100) DEFAULT NULL,
  "fallback_code" varchar(20) NOT NULL DEFAULT '',
  "params" text NOT NULL,
  "ordering" integer NOT NULL DEFAULT '0',
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "#__cbadvsearch_forms_saved";

CREATE TABLE "#__cbadvsearch_forms_saved" (
  "id" serial NOT NULL,
  "form_name" varchar(255) NOT NULL,
  "cb_user_id" integer NOT NULL DEFAULT '0',
  "default_form" tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY ("id"),
  CONSTRAINT "#__cbadvsearch_forms_saved_uc_unic" UNIQUE ("form_name","cb_user_id")
);
CREATE INDEX "#__cbadvsearch_forms_saved_idx_name" ON "#__cbadvsearch_forms_saved" ("form_name");
CREATE INDEX "#__cbadvsearch_forms_saved_idx_owner" ON "#__cbadvsearch_forms_saved" ("cb_user_id");

DROP TABLE IF EXISTS "#__cbadvsearch_forms_saved_items";

CREATE TABLE "#__cbadvsearch_forms_saved_items" (
  "id" serial NOT NULL,
  "form_id" varchar(255) NOT NULL,
  "cb_user_id" integer NOT NULL DEFAULT '0',
  "cb_field_name" char(30) not null,
  "cb_field_value" varchar(255) NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "#__cbadvsearch_forms_saved_items_uc_unic" UNIQUE ("form_id","cb_user_id")
);
CREATE INDEX "#__cbadvsearch_forms_saved_items_idx_form_id" ON "#__cbadvsearch_forms_saved_items" ("form_id");
CREATE INDEX "#__cbadvsearch_forms_saved_items_idx_owner" ON "#__cbadvsearch_forms_saved_items" ("cb_user_id");
CREATE INDEX "#__cbadvsearch_forms_saved_items_idx_field_name" ON "#__cbadvsearch_forms_saved_items" ("cb_field_name");
CREATE INDEX "#__cbadvsearch_forms_saved_items_idx_field_value" ON "#__cbadvsearch_forms_saved_items" ("cb_field_value");

DROP TABLE IF EXISTS "#__cbadvsearch_result_list_ignored";

CREATE TABLE "#__cbadvsearch_result_list_ignored" (
  "id" serial NOT NULL,
  "cb_user_owner_id" integer NOT NULL DEFAULT '0',
  "cb_user_ignored_id" integer NOT NULL DEFAULT '0',
  PRIMARY KEY ("id"),
  CONSTRAINT "#__cbadvsearch_result_list_ignored_uc_unic" UNIQUE ("cb_user_owner_id","cb_user_ignored_id")
);
CREATE INDEX "#__cbadvsearch_result_list_ignored_idx_owner" ON "#__cbadvsearch_result_list_ignored" ("cb_user_owner_id");
CREATE INDEX "#__cbadvsearch_result_list_ignored_idx_ignored" ON "#__cbadvsearch_result_list_ignored" ("cb_user_ignored_id");

DROP TABLE IF EXISTS "#__cbadvsearch_result_list_saved";

CREATE TABLE "#__cbadvsearch_result_list_saved" (
  "id" serial NOT NULL,
  "list_name" varchar(255) NOT NULL,
  "cb_user_id" integer NOT NULL DEFAULT '0',
  PRIMARY KEY ("id"),
  CONSTRAINT "#__cbadvsearch_result_list_saved_uc_unic" UNIQUE ("list_name","cb_user_id")
);
CREATE INDEX "#__cbadvsearch_result_list_saved_idx_cb_user_id" ON "#__cbadvsearch_result_list_saved" ("cb_user_id");
CREATE INDEX "#__cbadvsearch_result_list_saved_idx_list_name" ON "#__cbadvsearch_result_list_saved" ("list_name");

DROP TABLE IF EXISTS "#__cbadvsearch_result_list_saved_items";

CREATE TABLE "#__cbadvsearch_result_list_saved_items" (
  "id" serial NOT NULL,
  "cb_search_list_id" integer NOT NULL DEFAULT '0',
  "cb_user_owner_id" integer NOT NULL DEFAULT '0',
  "cb_user_found_id" integer NOT NULL DEFAULT '0',
  PRIMARY KEY ("id"),
  CONSTRAINT "#__cbadvsearch_result_list_ignored_uc_unic" UNIQUE ("cb_search_list_id","cb_user_owner_id","cb_user_found_id")
);
CREATE INDEX "#__cbadvsearch_result_list_saved_items_idx_list" ON "#__cbadvsearch_result_list_saved_items" ("cb_search_list_id");
CREATE INDEX "#__cbadvsearch_result_list_saved_items_idx_owner" ON "#__cbadvsearch_result_list_saved_items" ("cb_user_owner_id");
CREATE INDEX "#__cbadvsearch_result_list_saved_items_idx_found" ON "#__cbadvsearch_result_list_saved_items" ("cb_user_found_id");
