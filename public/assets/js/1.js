function freeze_pane_listener(what_is_this, table_class) {
  // Wrapping a function so that the listener can be defined
  // in a loop over a set of scrolling table id's.
  // Cf. http://stackoverflow.com/questions/750486/javascript-closure-inside-loops-simple-practical-example
  
  return function() {
    var i;
    var translate_y = "translate(0," + what_is_this.scrollTop + "px)";
    var translate_x = "translate(" + what_is_this.scrollLeft + "px,0px)";
    var translate_xy = "translate(" + what_is_this.scrollLeft + "px," + what_is_this.scrollTop + "px)";
    
    var fixed_vertical_elts = document.getElementsByClassName(table_class + " freeze_vertical");
    var fixed_horizontal_elts = document.getElementsByClassName(table_class + " freeze_horizontal");
    var fixed_both_elts = document.getElementsByClassName(table_class + " freeze");
    
    // The webkitTransforms are for a set of ancient smartphones/browsers,
    // one of which I have, so I code it for myself:
    for (i = 0; i < fixed_horizontal_elts.length; i++) {
      fixed_horizontal_elts[i].style.webkitTransform = translate_x;
      fixed_horizontal_elts[i].style.transform = translate_x;
    }

    for (i = 0; i < fixed_vertical_elts.length; i++) {
       fixed_vertical_elts[i].style.webkitTransform = translate_y;
       fixed_vertical_elts[i].style.transform = translate_y;
    }

    for (i = 0; i < fixed_both_elts.length; i++) {
       fixed_both_elts[i].style.webkitTransform = translate_xy;
       fixed_both_elts[i].style.transform = translate_xy;
    }
  }
}

function even_odd_color(i) {
  if (i % 2 == 0) {
    return "#e0e0e0";
  } else {
    return "#ffffff";
  }
}

function parent_id(wanted_node_name, elt) {
  // Function to work up the DOM until it reaches
  // an element of type wanted_node_name, and return
  // that element's id.
  
  var wanted_parent = parent_elt(wanted_node_name, elt);
  
  if ((wanted_parent == undefined) || (wanted_parent.nodeName == null)) {
    // Sad trombone noise.
    return "";
  } else {
    return wanted_parent.id;
  }
}

function parent_elt(wanted_node_name, elt) {
  // Function to work up the DOM until it reaches 
  // an element of type wanted_node_name, and return
  // that element.
  
  var this_parent = elt.parentElement;
  if ((this_parent == undefined) || (this_parent.nodeName == null)) {
    // Sad trombone noise.
    return null;
  } else if (this_parent.nodeName == wanted_node_name) {
    // Found it:
    return this_parent;
  } else {
    // Recurse:
    return parent_elt(wanted_node_name, this_parent);
  }
}

var i, parent_div_id, parent_tr, table_i, scroll_div;
var scrolling_table_div_ids = ["scrolling_table_1", "scrolling_table_2"];

// This array will let us keep track of even/odd rows:
var scrolling_table_tr_counters = [];
for (i = 0; i < scrolling_table_div_ids.length; i++) {
  scrolling_table_tr_counters.push(0);
}

// Append the parent div id to the class of each frozen element:
var fixed_elements = document.getElementsByClassName("fixed");
for (i = 0; i < fixed_elements.length; i++) {
  fixed_elements[i].className += " " + parent_id("DIV", fixed_elements[i]);
}

// Set background colours of row headers, alternating according to 
// even_odd_color(), which should have the same values as those
// defined in the CSS for the tr_shaded class.
var fixed_horizontal_elements = document.getElementsByClassName("freeze_horizontal");
for (i = 0; i < fixed_horizontal_elements.length; i++) {
  parent_div_id = parent_id("DIV", fixed_horizontal_elements[i]);
  table_i = scrolling_table_div_ids.indexOf(parent_div_id);
  
  if (table_i >= 0) {
    parent_tr = parent_elt("TR", fixed_horizontal_elements[i]);
    
    if (parent_tr.className.match("tr_shaded")) {
      fixed_horizontal_elements[i].style.backgroundColor = even_odd_color(scrolling_table_tr_counters[table_i]);
      scrolling_table_tr_counters[table_i]++;
    }
  }
}

// Add event listeners.
for (i = 0; i < scrolling_table_div_ids.length; i++) {
  scroll_div = document.getElementById(scrolling_table_div_ids[i]);
  scroll_div.addEventListener("scroll", freeze_pane_listener(scroll_div, scrolling_table_div_ids[i]));
}