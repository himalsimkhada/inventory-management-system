@php

// use DNS1D;

// echo DNS2D::getBarcodeHTML('https://www.google.com/', 'QRCODE');
// echo DNS2D::getBarcodePNGPath('https://www.google.com/', 'PDF417');
// echo DNS2D::getBarcodeSVG('https://www.google.com/', 'DATAMATRIX');


// echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('sams-123123', 'C39+',3,33) . '" alt="barcode"   />';
$barcode = base64_decode(DNS1D::getBarcodePNG('sams-123123', 'C39+',3,33));

echo $barcode;

echo '<img src="data:image/png;base64,' . $barcode . '" alt="">';

echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+',3,33,array(1,1,1), true) . '" alt="barcode"   />';

@endphp
