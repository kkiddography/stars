<?php

	/* Receive data from client - client.html */
	$data = $_REQUEST; // store the data retrieved from ajax call

    // [1.] Star name
	$name = $data['star_name']; // collect the input from form input 'star_name'

    // [2.] Star distance
	$distance_one = $_POST['star_distance_one'];
	$distance_two = $_POST['star_distance_two'];
	$distance_three = $_POST['star_distance_three'];

    // [3.] Star constellation
	$constellation = $_POST['star_constellation'];

	// results array
	$results = array();

	// data array
	$star_data = array(
			array('name' => 'Proxima Centauri', 'distance' => '4.243',  'constellation' => 'Centaurus',         'evolution' => 'Red Dwarf'),
        array('name' => 'Alpha Centauri A', 'distance' => '4.37',   'constellation' => 'Centaurus',         'evolution' => 'Main Sequence'),
        array('name' => 'Alpha Centauri B', 'distance' => '4.37',   'constellation' => 'Centaurus',         'evolution' => 'Main Sequence'),
        array('name' => 'Barnards Star',    'distance' => '5.978',  'constellation' => 'Ophiuchus',         'evolution' => 'Red Dwarf'),
        array('name' => 'Wolf 359',         'distance' => '7.86',   'constellation' => 'Leo',               'evolution' => 'Red Dwarf'),
        array('name' => 'Lalande 21185',    'distance' => '8.31',   'constellation' => 'Ursa Major',        'evolution' => 'Red Dwarf'),
        array('name' => 'Sirius A',         'distance' => '8.60',   'constellation' => 'Canis Major',       'evolution' => 'Main Sequence'),
        array('name' => 'Sirius B',         'distance' => '8.60',   'constellation' => 'Canis Major',       'evolution' => 'White Dwarf'),
        array('name' => 'Luyten 726-8 A',   'distance' => '8.73',   'constellation' => 'Cetus',             'evolution' => 'Red Dwarf'),
        array('name' => 'Luyten 726-8 B',   'distance' => '8.73',   'constellation' => 'Cetus',             'evolution' => 'Red Dwarf'),
        array('name' => 'Ross 154',         'distance' => '	9.60',  'constellation' => 'Sagittarius',       'evolution' => 'Red Dwarf'),
        array('name' => 'Ross 248',         'distance' => '10.30',  'constellation' => 'Andromeda',         'evolution' => 'Red Dwarf'),
        array('name' => 'Epsilon Eridani',  'distance' => '10.475', 'constellation' => 'Eridanus',          'evolution' => 'Main Sequence'),
        array('name' => 'Lacaille 9352',    'distance' => '10.68',  'constellation' => 'Piscis Austrinus',  'evolution' => 'Red Dwarf'),
        array('name' => 'Ross 128',         'distance' => '11.03',  'constellation' => 'Virgo',             'evolution' => 'Red Dwarf'),
        array('name' => 'Luyten 789-6 A',   'distance' => '11.1',   'constellation' => 'Aquarius',          'evolution' => 'Red Dwarf'),
        array('name' => 'Luyten 789-6 B',   'distance' => '11.1',   'constellation' => 'Aquarius',          'evolution' => 'Red Dwarf'),
        array('name' => 'Luyten 789-6 C',   'distance' => '11.1',   'constellation' => 'Aquarius',          'evolution' => 'Red Dwarf'),
        array('name' => 'Procyon A',        'distance' => '11.46',  'constellation' => 'Canis Minor',       'evolution' => 'Main Sequence'),
        array('name' => 'Procyon B',        'distance' => '11.46',  'constellation' => 'Canis Minor',       'evolution' => 'White Dwarf')
	);

// distance filters
$distance_far = 5;
$distance_farther = 10;
$distance_farthest = 15;

// If no distance or constellation selected, search for name...
if (($distance  != $distance_far)  && ($distance  != $distance_farther) && ($distance  != $distance_farthest) ) {
	for( $count = 0 ; $count < count( $star_data ) ; $count++ ) {
		if( stripos( $star_data[$count]['name'] , $name ) !== false ) {
			array_push( $results , $star_data[$count] );
		}
	}
}
// <5 filter selected...
if ($distance_one == $distance_far) {
	for( $count = 0 ; $count < count( $star_data ) ; $count++ ) {
		if( $star_data[$count]['distance']  <= $distance_far ) {
			array_push( $results , $star_data[$count] );
		}
	}
}
// 5 - 10 filter selected...
if ($distance_two == $distance_farther) {
	for( $count = 0 ; $count < count( $star_data ) ; $count++ ) {
		if( $star_data[$count]['distance']  <= $distance_farther && $star_data[$count]['distance']  >= $distance_far ) {
			array_push( $results , $star_data[$count] );
		}
	}
}
// 10+ filter selected...
if ($distance_three == $distance_farthest) {
	for( $count = 0 ; $count < count( $star_data ) ; $count++ ) {
		if( $star_data[$count]['distance']  >= $distance_farther ) {
			array_push( $results , $star_data[$count] );
		}
	}
}

// constellation dropdown
if ($constellation != null) {
	for( $count = 0 ; $count < count( $star_data ) ; $count++ ) {
		if( stripos( $star_data[$count]['constellation'] , $constellation ) !== false ) {
			array_push( $results , $star_data[$count] );
		}
	}
}

// Return Response as JSON
echo json_encode( $results );

?>
