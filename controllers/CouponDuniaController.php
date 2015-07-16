<?php
namespace app\controllers;
use app\models\Coupon;
use app\models\Website;
use PHPExcel;
use app\models\CouponCategories;
use Yii;
class CouponDuniaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $coupons = new Coupon;
        $resultType = $coupons->couponType();
        
        $websites = new Website();
        $resultStores = $websites->websiteName();
        
        $coupons = new CouponCategories();
        $resultCategory = $coupons->storesName();
        
        $coupons = new Coupon;
        $resultDetail = $coupons->couponDetail();
        
        return $this->render('index', ['resultType' => $resultType,
            'resultStores' => $resultStores,
            'resultCategory' => $resultCategory,
            'resultDetail' => $resultDetail
            ]);
    }
    
    public function actionDisplayCoupon() {
        $site = $_GET['site'];
        $couponDetail = new Coupon;
        $result = $couponDetail->couponDetailBySite($site);
        if(count($result) == 0) {
          echo '<strong>oops!!</strong><br>Looks like there\'s no offer for you...:(<br>';
        } else {
            return $this->renderPartial('displaycoupon', ['site' => $site, 'resultStore' => $result]);
        }
    }
    
    
    public function actionDownload($type = 'none', $value = 'none') {
        
        
        //        for($col = 'A'; $col !== 'G'; $col++) {
//            $ea->getActiveSheet()
//               ->getColumnDimension($col)
//                ->setAutoSize(true);
//        }
//        
        if($type == '' && $value == '') {
            $couponDetail = new Coupon;
            $result = $couponDetail->couponDetail();
        } else if($type == 'category') {
            $couponDetail = new Coupon;
            $result = $couponDetail->couponDetailByCategory($value);
        } else if($type == 'coupontype') {
            $couponDetail = new Coupon;
            $result = $couponDetail->couponDetailByType($value);
        } else if($type == 'store') {
            $couponDetail = new Coupon;
            $result = $couponDetail->couponDetailBySite($value);
        } 
        
        $data = array();
        
            array_push($data, array('Coupon Type' => "Coupon Type",
                'Store name' => 'Store name',
                'Coupon Description' => 'Coupon Description',
                'Coupon Expiry' => 'Coupon Expiry',
                'Coupon Code' => 'Coupon Code',
                'store url' => 'Store URL'
                ));
        
            foreach ($result as $row) {
            
                array_push($data, array('Coupon Type' => $row['CouponType'],
                    'Store name' => $row['Site'],
                    'Coupon Description' => $row['Description'],
                    'Coupon Expiry' => 100,
                    'Coupon Code' => $row['CouponCode'],
                    'store url' => $row['url']
                    ));
            }
        //return $this->render('testing',['data'=>$data]);
        
        
        // Create new PHPExcel object ea
        $ea = new \PHPExcel();
        
        // Fill worksheet from values in array
        $ea->getActiveSheet()->fromArray($data, null, 'A1',true);
           // ->setAutoSize(true);
        // Rename worksheet
        $ea->getActiveSheet()->setTitle('Members');
        
        

        // to save the file
        $writer = \PHPExcel_IOFactory::createWriter($ea, 'Excel2007');
        $writer->setIncludeCharts(true);
        $writer->save('downloadedCoupon.xlsx');
        $fileLocation = '../web/downloadedCoupon.xlsx';
        
    }
    
    
    
    
    
    public function actionDisplayCouponByCategory() {
        $category = $_GET['cat'];
        $couponDetail = new Coupon;
        $resultcategory = $couponDetail->couponDetailByCategory($category);
        if(count($resultcategory) == 0) {
          echo '<strong>oops!!</strong><br>Looks like there\'s no offer for you...:(<br>';
        } else {
            return $this->renderPartial('displaycouponbycategory', ['cat' => $category, 'resultCategory' => $resultcategory]);
        }
    }
    public function actionDisplayCouponByType() {
        $type = $_GET['type'];
        $couponDetail = new Coupon;
        $resultType = $couponDetail->couponDetailByType($type);
        if(count($resultType) == 0) {
          echo '<strong>oops!!</strong><br>Looks like there\'s no offer for you...:(<br>';
        } else {
        return $this->renderPartial('displaycouponbytype', ['resultType' => $resultType]);
        }
    }
    
    
}