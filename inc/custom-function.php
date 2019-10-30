<?php

// filter for phone
function filter_phone( $phone ) {
	$filter_phone = str_replace( array( ' ', '(', ')', '-' ), '', $phone );
	return $filter_phone;
}
