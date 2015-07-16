var filterType = '';
var filterValue = '';

function dispCoupon(Site){
    filterType = 'store';
    filterValue = Site;
    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
      }
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('CouponDisplay').innerHTML = xmlhttp.responseText;
           }
    }
    xmlhttp.open('GET', "http://localhost:8888/basic/web/index.php?r=coupon-dunia/display-coupon&site="+Site, true);
    xmlhttp.send();
}




// for onclick event of filter by category

function dispCouponByCategory(category) {

    filterType = 'category';
    filterValue = category;
    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
      }
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('CouponDisplay').innerHTML = xmlhttp.responseText;
           }
    }
    xmlhttp.open('GET', "http://localhost:8888/basic/web/index.php?r=coupon-dunia/display-coupon-by-category&cat="+category, true);
    xmlhttp.send();
}

// for onclick event of filter by type
function dispCouponByType(type) {

    filterType = 'coupontype';
    filterValue = type;
    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
      }
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('CouponDisplay').innerHTML = xmlhttp.responseText;
           }
    }
    
    xmlhttp.open('GET', "http://localhost:8888/basic/web/index.php?r=coupon-dunia/display-coupon-by-type&type="+type, true);

    xmlhttp.send();

}
// for onclick event of download

function downloadCoupon() {

    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function() {

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert('File downloaded to path : "web/downloadedCoupon.xlsx"');
        }
    }
    //document.write("yyyyyy");
    xmlhttp.open('GET', "http://localhost:8888/basic/web/index.php?r=coupon-dunia/download&type="+filterType+"&value="+filterValue, true);
    xmlhttp.send();
}
