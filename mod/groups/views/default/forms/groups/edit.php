<?php
/**
 * Group edit form
 *
 * @package ElggGroups
 */

/* @var ElggGroup $entity */
$entity = elgg_extract("entity", $vars, false);

// context needed for input/access view
elgg_push_context("group-edit");

// build the group profile fields
echo elgg_view("groups/edit/profile", $vars);

// build the group access options
echo elgg_view("groups/edit/access", $vars);

// build the group tools options
echo elgg_view("groups/edit/tools", $vars);

// display the save button and some additional form data
if ($entity) {
	echo elgg_view("input/hidden", [
		"name" => "group_guid",
		"value" => $entity->getGUID(),
	]);
}

// build form footer
$footer = '';
if (!empty($entity) && $entity->canDelete()) {
	// add delete link
	$footer .= elgg_view("output/url", [
		"text" => elgg_echo("groups:delete"),
		"href" => "action/groups/delete?guid={$entity->guid}",
		"confirm" => elgg_echo("groups:deletewarning"),
		"class" => "elgg-button elgg-button-delete float-alt",
	]);
}

// save button
$footer .= elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('save'),
]);

elgg_set_form_footer($footer);

elgg_pop_context();
