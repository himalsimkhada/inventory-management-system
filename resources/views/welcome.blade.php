@php

// echo DNS2D::getBarcodeHTML('https://www.google.com/', 'QRCODE');
// echo DNS2D::getBarcodePNGPath('https://www.google.com/', 'PDF417');
// echo DNS2D::getBarcodeSVG('https://www.google.com/', 'DATAMATRIX'); 

echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('sams-123123', 'C39+',3,33) . '" alt="barcode"   />';

echo DNS1D::getBarcodePNG('sams-123123', 'C39+',3,33);

@endphp