<?php
	// populate the array of available header images
	$_headers = array(
					"h-barcelona.jpg",
					"h-barcelona2.jpg",
					"h-barcelona3.jpg",
					"h-belfast.jpg",
					"h-belfast2.jpg",
					"h-belfast3.jpg",
					"h-egypt.jpg",
					"h-feet.jpg",
					"h-geneva.jpg",
					"h-grass.jpg",
					"h-interlaken.jpg",
					"h-interlaken2.jpg",
					"h-interlaken3.jpg",
					"h-munich.jpg",
					"h-munich2.jpg",
					"h-paris.jpg",
					"h-rhine.jpg",
					"h-rhine2.jpg"
					);
	// "h-munich2.jpg" left out for now

	// randomly pick a header
	$_hIndex = rand(0, count($_headers) - 1);

	// now output the necessary CSS
	echo "		#pageHeader { background-image: url(/images/".$_headers[$_hIndex].") !important; }\n";
?>
