
                                   Manual
                                   ------

== Create the whole process ==

This integration could save all informations give by capsule create a person, and 
the opportunity depandant, a task in the calendar, calculate a **Expected Value**
following quantity given in the form.

This plugin can transform a form in an person in one of the following capsuleCRM
types :

 - person
 - organisation
 - opportunity
 - case
 - task
 - history

By default a form is connected to person all provided fields presents in capsule.

All change must be made on the file **api/transformation_table.php**.

== Form Fields ==

Fields will be automatically mapped by CapsuleCRM using the Gravity Forms Admin
Label or if Admin Label not filled, with the Label.

If you change the labels of your fields, make sure to use the following keywords
in the label to match and send data to CapsuleCRM.

	- name: must be use with the name field
	- organisationName
	- email ( default type: Work, one of Home | Work )
	- phone ( default type: Work, one of Home | Work | Mobile | Fax )
	- address ( default type: Work one of Home | Office | Postal )
	- website ( default type: Work, one of Home | Work )
		(default webService:URL one of URL | SKYPE | TWITTER | LINKED_IN | 
		FACEBOOK | XING | FEED | GOOGLE_PLUS | FLICKR | GITHUB | YOUTUBE)
	- subject
	- jobTitle
	- about
	- tag

For **phone**, **address**, **website** and **email**, you can define the type
by edit the api/transformation_table.php file.

Additionals part could be also to integrate:

	- history
	- case
	- task
	- opportunity

If you want connect the person to an opportunity, you should too edit the
transformation_table.

== Provide id (person_id or organisation) ==
 
If you connect your form to an opportunity, an history or a case, a party_id could
be defined as an hidden field labeled `id` with the correct default value.

A party id is the id of a person or an organisation, there are considerate in 
concanate space called party. You can know a party_id in going on your
capsulecrm page after choose a person or an organisation. The url should then be
in the form `http://yourid.capsulecrm.com/party/*a number* `. This number is
the party_id.

== Others forms ==

Other forms could be use to know what field is available for additionnal parts of
a person or to create specials forms for particuliar customer. Be very carefull
with label name.

<h4> Destination in hidden field </h4>
If you want to change the destination (save primarily a task, an opportunity,
a case,...) you must use an `hidden field` with `_capsuleType` as label  and 
the name of the type (organisation, opportunity, ...) as `Default Value`.

Names of type:

 - person
 - organisation
 - opportunity
 - case
 - task
 - history

Others form are  and provide there fields

=== Opportunity ===

opportunity

   - id
   - name
   - description
   - currency
   - value
   - durationBasis
   - duration
   - expectedCloseDate
   - milestone
   - owner
	
with special Parts:

   - tag
   - case
   - history
   - task

=== Case ===
	
case

   - id
   - status
   - name
   - description
   - closeDate
   - owner
   - tag
   - history
   - person
   - organisation
   - task
	
=== Task ===
	
task:
   - id
   - description
   - category
   - dueDate
   - dueDateTime
   - owner
   - partyId
   - partyName
   - opportunityId
   - opportunityName
   - caseId
   - caseName	
	
=== SubForm Definition ===

historyItem:
   - id
   - type
   - entryDate      
   - creator
   - subject
   - note

customField:
   - tag
   - label
   - date
   - boolean
   - text