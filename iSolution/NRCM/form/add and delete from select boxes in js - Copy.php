<html>
<head>
<title>List UI test</title>
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
var list_1 = [
<?php

$elements = array(
	1 => '1. apple',
	2 => '2. ball (5.2)',
	5 => '2.1.1. shoe',
	6 => '3. dog',
	7 => '0.1. antelope'
);

foreach ($elements as $id => $text) {
	echo "{id: $id, text: '$text'},\n";
}

?>
];

var list_2 = [
<?php

$elements = array(
	3 => '2.1. fish',
	4 => '2.2. rope'
);

foreach ($elements as $id => $text) {
	echo "{id: $id, text: '$text'},\n";
}

?>
];

function set_data(selector, data) {
	$(selector).data('data', data);
}

function set_filters(selector, sort_fn, filter_fn) {
	$(selector).data('sort_fn', sort_fn);
	$(selector).data('filter_fn', filter_fn);
}

function remove_item(selector, id) {
	var item;
	var data = $.grep($(selector).data('data'), function (value, index) {
		if (value.id == id) item = value;
		return value.id != id;
	});
	$(selector).data('data', data);
	return item;
}

function add_item(selector, item) {
	$(selector).data('data').push(item);
}

function layout_list(selector) {
	var data = $(selector).data('data').slice(0);
	if ($(selector).data('sort_fn')) data.sort($(selector).data('sort_fn'));
	if ($(selector).data('filter_fn')) data = $.map(data, $(selector).data('filter_fn'));
	$(selector).empty();
	for (var i = 0; i < data.length; i++) {
		$(selector).append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
	}
}

function sort_numeric(a, b) {
	var a_num = a.text.trim().match(/^([0-9]+\.?)+/)[0].split('.');
	var b_num = b.text.trim().match(/^([0-9]+\.?)+/)[0].split('.');
	for (var i = 0; i < a_num.length && i < b_num.length; i++) {
		if (a_num[i] != b_num[i]) return a_num[i] - b_num[i];
	}
	if (i >= a_num.length) return -1;
	if (i >= b_num.length) return 1;
	return 0;
}

function sort_alpha(a, b) {
	var a_text = a.text.trim().match(/^([0-9]+\.?)+\s*(.*)/)[2];
	var b_text = b.text.trim().match(/^([0-9]+\.?)+\s*(.*)/)[2];
	return a_text.localeCompare(b_text);
}

function filter_move_numbers(value, index) {
	var parts = value.text.match(/^(([0-9]+\.?)+)\s*(.*)/);
	return {
		id: value.id,
		text: parts[3] + ' (' + parts[1] + ')'
	};
}

function move_selected(selector_a, selector_b) {
	$(selector_a + ' option:selected').each(function () {
		add_item(selector_b, remove_item(selector_a, $(this).attr('value')));
	});
}

$(document).ready(function () {
	set_data('#list1', list_1);
	set_data('#list2', list_2);
	set_filters('#list1', sort_numeric, null);
	set_filters('#list2', sort_numeric, null);
	layout_list('#list1');
	layout_list('#list2');
});
</script>
</head>
<body>
<p>
This is a list:<br>
<div style="float: left;"></div>
<select multiple id="list1" style="float: left; width: 15em; height: 20em;">
</select>
<div style="float: left; padding-top: 5em;">
<button onclick="move_selected('#list1', '#list2'); layout_list('#list1'); layout_list('#list2');">&rarr;</button><br>
<button onclick="move_selected('#list2', '#list1'); layout_list('#list1'); layout_list('#list2');">&larr;</button>
</div>
<select multiple id="list2" style="width: 15em; height: 20em;">
</select>
</p>
<p>
You can sort and filter the <b>first list</b> using these buttons:<br>
<button onclick="set_filters('#list1', sort_numeric, null); layout_list('#list1');">Numeric sort</button>
<button onclick="set_filters('#list1', sort_alpha, filter_move_numbers); layout_list('#list1');">Alphabetic sort</button>
</p>
<p>
You can sort and filter the <b>second list</b> using these buttons:<br>
<button onclick="set_filters('#list2', sort_numeric, null); layout_list('#list2');">Numeric sort</button>
<button onclick="set_filters('#list2', sort_alpha, filter_move_numbers); layout_list('#list2');">Alphabetic sort</button>
</p>
</body>
</html>
