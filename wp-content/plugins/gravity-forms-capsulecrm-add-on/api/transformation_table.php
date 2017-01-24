<?php
$personnal_table = array
(
	"forms"=>array(
		// The contact form
		// ================
		// In this form i have configure just what needed and comment
		// the default values provide by the system
		//
		/*
		"Contact Form"=>array(//Form are reference by title
			"parameters"=>array(
				"primary"=>"person",
				// Queue is used to organised the order of request to capsule
				// ----------------------------------------------------------
				"queue" => array(
					"person"=>"update_or_create",
					"contacts"=>"update_or_create",
					"history_1"=>"create",
					"history_2"=>"create",
					"customField"=>"update_or_create",
				),
				// Transformed entities permit to rename internal entity use here to capsule entities
				// ----------------------------------------------------------------------------------
				"transformed_entities" => array(
					"history_1"=>"history",
					"history_2"=>"history",
					"history_3"=>"history",
				),
			),
			// Field transform gravity form fields in internal format
			// ------------------------------------------------------
			// The first identifiant is the field's name like in gravity
			// The parameters are the internals name with as consequences
			// that each gravity field could be duplicated.
			// It is also possible to integrate transformation with the 
			// prefixe ___toTransform___::: and this rules :
			//  - to remplace a predefined var enclose by {field_name} by its value
			//  - to calcule an expression inside {% expression %}
			//  - to defined a variable {variable_name=value}
			// ------------------------------------------------------
			"fields"=>array(
				//"hidden_subject"=>array("history>subject"),
				//"first_name"=>array("_primary>firstName"),
				//"last_name"=>array("_primary>lastName"),
				//"email"=>array("contacts>_multiple>email>emailAddress"),
				//"phone"=>array("contacts>_multiple>phone>phoneNumber","contacts>_multiple>phone>type"=>"work"),
				"Team or Company Name" => array("_primary>organisationName"),
				"Do You Want To Join Our Newsletter?"           => array("customField>boolean" => "true", "customField>label" =>"Newsletter"),
				"Session Information"  => array("history_1>note"               , "history_3>note"    =>"note parametized in the config file"),
				"Subject"              => array("history_2>note"),				
			),
		),*/
		#################################################################################################
		"Phone Quote"=>array(		
			"parameters"=>array(
				"primary"=>"person",
				//This is the order in which the fields will be save on capsule
				"queue" => array(
					"person"              => "update_or_create",
					"contacts"            => "update_or_create",
					"session"             => "create",
					"comefrom"            => "update_or_create",
					"newsletter"          => "update_or_create",
					"opportunity"         => "create",
					"customer_artwork1"   => "create",
					"customer_artwork2"   => "create",
					"size"                => "create",
					"delivery_date"       => "create",
					"quantity"            => "create",
					"design"              => "create",
					"type"                => "create",
					"opportunity_history" => "create",					
				),
				//Transform internal name in capsule name
				"transformed_entities" => array(
					"session"             => "history",
					"comefrom"            => "customField",
					"customer_artwork1"   => "history",
					"customer_artwork2"   => "history",
					"newsletter"          => "customField",
					"size"                => "customField",
					"delivery_date"       => "customField",
					"quantity"            => "customField",
					"design"              => "note",
					"type"                => "customField",
					"opportunity_history" => "history",
				),
			),			
			"fields"=>array(
				//The contact
				"Team or Company Name"                  => array("_primary>organisationName"),
				"Session Information"                   => array("session>note"),
				"Shipping Address"                      => array("contacts>_multiple>address", "contacts>_multiple>address>str_type"=>"Shipping"),
				"Do you want to join our newsletter?"   => array("newsletter>boolean"=>"true", "newsletter>label"=>"Newsletter"),
				 //If you update a Cutom Field like this, you must integrate is_boolean=>false
				"How Did You Hear About Us?" 			    => array("comefrom>text", "comefrom>label"=>"I Come From", "comefrom>boolean"=>"true", "comefrom>is_boolean"=>"false"),							
				//Begin the opportunity
				"When Do You Need Them?"=>array(
					"opportunity>name"              => "___toTransform___:::Quote",
					"opportunity>milestone"         => "New",
					"opportunity_history>note"      => "Creation from wordpress phone quote form",
					"opportunity>value"             => "___toTransform___:::{%{How Many Pins Do You Need?}*2%}",
					"opportunity>expectedCloseDate" => "___toTransform___:::date",
					"delivery_date>date"            => '___toTransform___:::date', "delivery_date>label"=>"in Hands Date", "delivery_date>boolean"=>"true",
				),
				"Design Information"         => array("opportunity>description"=>"___toTransform___:::{value} {Attach Your Art 1} {Attach Your Art 2}"),
				"Attach Your Art 1"          => array("customer_artwork1>note"), 
				"Attach Your Art 2"          => array("customer_artwork2>note"), 
				//Custom field for opportunity
				"Type of Pin?"               => array("type>text",     "type>label"     => "Type"),
				"How Many Pins Do You Need?" => array("quantity>text", "quantity>label" => "Quantity",  "quantity>boolean"=>"true"),
				"What size do you need?"     => array("size>text",     "size>label"     => "Size",          "size>boolean"=>"true",),
				
			),
		),
		#################################################################################################
		"Quote"=>array(		
			"parameters"=>array(
				"primary"=>"person",
				//This is the order in which the fields will be save on capsule
				"queue" => array(
					"person"              => "update_or_create",
					"contacts"            => "update_or_create",
					"session"             => "create",
					"comefrom"            => "update_or_create",
					"newsletter"          => "update_or_create",
					"opportunity"         => "create",
					"customer_artwork1"   => "create",
					"customer_artwork2"   => "create",
					"customer_artwork3"   => "create",
					"size"                => "create",
					"delivery_date"       => "create",
					"quantity"            => "create",
					"design"              => "create",
					"metal"               => "create",
					"type"                => "create",
					"clutch"              => "create",
					"opportunity_history" => "create",					
				),
				//Transform internal name in capsule name
				"transformed_entities" => array(
					"session"             => "history",
					"comefrom"            => "customField",
					"customer_artwork1"   => "history",
					"customer_artwork2"   => "history",
					"customer_artwork3"   => "history",
					"newsletter"          => "customField",
					"size"                => "customField",
					"delivery_date"       => "customField",
					"quantity"            => "customField",
					"design"              => "customField",
					"type"                => "customField",
					"metal"               => "customField",
					"clutch"              => "customField",
					"opportunity_history" => "history",
				),
			),			
			"fields"=>array(
				//The contact
				"Team or Company Name"                  => array("_primary>organisationName"),
				"Session Information"                   => array("session>note"),
				//"Shipping Address"                      => array("contacts>_multiple>address", "contacts>_multiple>address>str_type"=>"Shipping"),
				"Do you want to join our newsletter?"   => array("newsletter>boolean"=>"true", "newsletter>label"=>"Newsletter"),
				"How Did You Hear About Us?" 			    => array("comefrom>text", "comefrom>label"=>"I Come From", "comefrom>boolean"=>"true", "comefrom>is_boolean"=>"false"),							
				//Begin the opportunity
				"When Do You Need Them?"=>array(
					"opportunity>name"              => "___toTransform___:::Quote",
					"opportunity>milestone"         => "New",
					"opportunity_history>note"      => "Creation from wordpress phone quote form",
					"opportunity>value"             => "___toTransform___:::{%{How Many Pins Do You Need?}*2%}",
					"opportunity>expectedCloseDate" => "___toTransform___:::date",
					"delivery_date>date"            => '___toTransform___:::date', "delivery_date>label"=>"in Hands Date", "delivery_date>boolean"=>"true",
				),
				"Design Information"          => array("opportunity>description"=>"___toTransform___:::{value} {Attach Your Art} {Attach Your Art #2} {Attach Your Art #3}"),
				"Attach Your Art"             => array("customer_artwork1>note"), 
				"Attach Your Art #2"          => array("customer_artwork2>note"), 
				"Attach Your Art #3"          => array("customer_artwork3>note"), 
				//Custom field for opportunity
				"Type of Pin?"                              => array("type>text",         "type>label" => "Type",          "type>boolean"=>"true"),
				"Metal Finish?"                             => array("metal>text",       "metal>label" => "Metal finish", "metal>boolean"=>"true"),
				"How Many Pins Do You Need?"                => array("quantity>text", "quantity>label" => "Quantity",  "quantity>boolean"=>"true"),
				"Size"                                      => array("size>text",         "size>label" => "Size",          "size>boolean"=>"true"),
				"What Type Of Clutch or Pin Back?"          => array("clutch>text",     "clutch>label" => "Clutch",      "clutch>boolean"=>"true"),
				"Do You Want To Tell Us About Your Design?" => array("design>text",     "design>label" => "Design",      "design>boolean"=>"true"),
				
			),
		),
################################################################################
###The two next forms are used to test##########################################
################################################################################
		//Correspond to each form here the title of the form - base test form
		"Request A Free Quote  xxxx"=>array(
			"parameters"=>array(
				//Used to prefixed the field to saved
				"primary"=>"person",
				//The queue give the dependance an history for a person couldn't
				//be place after an opportunity possible value are :				
				// update_or_create, create, update
				//for the update options you must specify the field used to search the result.
				//with the find_by parameter
				"queue" => array(
					"person"=>"update_or_create",
					"contacts"=>"update_or_create",
					"opportunity"=>"create",
					"customField_1"=>"create",
					"customField_2"=>"create",
					"customField_3"=>"create",
					"task"=>"create"
				),
				//Used to update and not create				
				"find_by" => array(),
				//For entities with multiples occurences, you must define each of them
				//with an unique name, and the transformation append at the end
				"transformed_entities" => array(
					"customField_1"=>"customField",
					"customField_2"=>"customField",
					"customField_3"=>"customField",
				)
			),
			//The fields transformed, the key is the name in wordpress
			//With that you can transform each field in other field
			//Each field must be well placed, like the api wait him
			//see the page http://capsulecrm.com/help/page/javelin_api_party
			//A custom field must be save independantly, but after the entity
			//it integrates
			"fields"=>array(
				"opportunity"=> array("opportunity>name", "opportunity>milestone"=>"Bid"),
				"quantity"   => array("customField_1>text", "customField_1>label"=>"Quantity", "customField_1>boolean"=>true),//A custom field must have a boolean to true, if not you get an error;
				"pin_type"   => array("customField_2>text", "customField_2>label"=>"Type of Pin", "customField_2>boolean"=>true),
				"size"       => array("customField_3>text", "customField_3>label"=>"Size", "customField_3>boolean"=>true),
				"date"       => array("opportunity>expectedCloseDate", "task>dueDate"),
				"task"       => array("task>description"),
			),
		),
		//A second form
		"Contact Us  xxxx"=>array(
			"parameters"=>array(
				"primary"=>"person",
				"queue" => array(
					"person"=>"update_or_create",
					"contacts"=>"update_or_create",
					"history1"=>"create",
					"history2"=>"create",
					//"customField"=>"create",
				),
				"transformed_entities" => array(
					"history1"=>"history",
					"history2"=>"history",
				)
			),
			"fields"=>array(
				"note1"=>array("history1>note"),
				"first_name"=>array("_primary>firstName"),
				"subject"=>array("history2>note"),
				"newsletter"=>array("customField>boolean"=>"true", "customField>label"=>"Newsletter"), 
			),
		),
	)
);

$default_parameters = array(
	"primary"=>"person",
);
$default_find_by = array(
	"person" => array("firstName", "lastName"),
	"customField" => array("label")
);

//Basic transformation rules
$transformation_table = array
(
	"First_Name"=>array("_primary>firstName"),
	"first_name"=>array("_primary>firstName"),
	"Last_Name"=>array("_primary>lastName"),
	"last_name"=>array("_primary>lastName"),
	"Email"=>array("contacts>_multiple>email>emailAddress","contacts>_multiple>email>type"=>"Work"),
	"email"=>array("contacts>_multiple>email>emailAddress","contacts>_multiple>email>type"=>"Work"),
	"home_Email"=>array("contacts>_multiple>email>emailAddress","contacts>_multiple>email>type"=>"Home"),
	"home_email"=>array("contacts>_multiple>email>emailAddress","contacts>_multiple>email>type"=>"Home"),
	"Phone"=>array("contacts>_multiple>phone>phoneNumber","contacts>_multiple>phone>type"=>"Work"),
	"phone"=>array("contacts>_multiple>phone>phoneNumber","contacts>_multiple>phone>type"=>"Work"),
	"home_Phone"=>array("contacts>_multiple>phone>phoneNumber","contacts>_multiple>phone>type"=>"Home"),
	"home_phone"=>array("contacts>_multiple>phone>phoneNumber","contacts>_multiple>phone>type"=>"Home"),
	"Address"=>array("contacts>_multiple>address"),
	"Company"=>array("_primary>organisationName"),
	//For next transformation i use my reason to write them, nothing in the documentation mention those
	"Website"=>array("contacts>_multiple>website>webAddress"),
	"website"=>array("contacts>_multiple>website>webAddress"),
	"facebook"=>array("contacts>_multiple>website>webAddress","contacts>_multiple>website>webService"=>"FACEBOOK"),
	"twitter"=>array("contacts>_multiple>website>webAddress","contacts>_multiple>website>webService"=>"twitter"),
	"linked_in"=>array("contacts>_multiple>website>webAddress","contacts>_multiple>website>webService"=>"linked_in"),
	"xing"=>array("contacts>_multiple>website>webAddress","contacts>_multiple>website>webService"=>"xing"),
	"blog"=>array("contacts>_multiple>website>webAddress","contacts>_multiple>website>webService"=>"FEED"),
	"google+"=>array("contacts>_multiple>website>webAddress","contacts>_multiple>website>webService"=>"GOOGLE_PLUS"),
	"flickr"=>array("contacts>_multiple>website>webAddress","contacts>_multiple>website>webService"=>"FLICKR"),
	"YOUTUBE"=>array("contacts>_multiple>website>webAddress","contacts>_multiple>website>webService"=>"YOUTUBE"),
	"GitHub"=>array("contacts>_multiple>website>webAddress","contacts>_multiple>website>webService"=>"GITHUB"),
);


#Administrative not usefull
$responses_entities = array(
	"root_response"=>array(
		"person"=>"parties",
		"organisation"=>"parties",
		"case"=>"kases",
		"opportunitity"=>"opportunities",
	),		
	"response"=>array(
		"person"=>"person",
		"organisation"=>"organisation",
		"case"=>"kases",
		"opportunitity"=>"opportunities",
	),		
	"create_child"=>array(
		"person"=>"party",
		"organisation"=>"party",
		"case"=>"kases",
		"opportunitity"=>"opportunities",
	),
	"search_child"=>array(
		"person"=>"party",
		"organisation"=>"party",
		"case"=>"kases",
		"opportunitity"=>"opportunities",
	),		
);

$gf_transformations = array(
	"address"=>array(
		"Street Address" => "street1",
		"Address Line 2" => "street2",
		"City" => "city",
		"State / Province" =>"state",
		"Zip / Postal Code" => "zip",
		"Country" => "country",
		"str_type" => "str_type",
	),		
);

$parentable_entities = array("person"=>true, "organisation"=>true, "opportunity"=>true, "case"=>true, "task"=>true);

$capsule_parameters = array(
	 'person'=>array('id', 'about', 'pictureURL', 'createdOn', 'updatedOn', 'title', 'firstName', 'lastName', 'jobTitle', 'organisationId', 'organisationName', 'contacts'),
	 'organisation'=>array('id', 'name', 'about', ),
	 'opportunity'=>array('id', 'name', 'description', 'currency', 'value', 'duration', 'Basis', 'duration', 'expectedCloseDate', 'milestone', 'owner'),
	 'kase'=>array('id', 'status', 'name', 'description', 'close', 'Date', 'owner', 'party_id',),
	 'task'=>array('id', 'description', 'category', 'due', 'Date', 'dueDateTime', 'owner', 'partyId', 'partyName', 'opportunityId', 'opportunityName', 'caseId', 'caseName',),
	 'address'=>array('id', 'type', 'street', 'city', 'state', 'zip', 'country', ),
	 'email'=>array('id', 'type', 'emailAddress'),
	 'phone'=>array('id', 'type', 'phoneNumber'),
	 'website'=>array('id', 'type', 'webAddress', 'webService', 'url', ),
	 'history'=>array('id', 'type', 'entryDate', 'creator', 'subject', 'note', ),
	 'tag'=>array('name', ),
	 'customField'=>array('tag', 'label', 'date', 'boolean', 'text', )
	 
);

$entities_with_contacts = array("person", "company");