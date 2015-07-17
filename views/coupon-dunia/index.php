<?php
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/index.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>



<br><br><br>
<div class="container">
    <div class="column">
        <div ><div class="col-sm-5">
            <div class="btn-group" >
                <button class="btn btn-primary">Filter by coupon type</button>
                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                     <?php foreach ($resultType as $name) {
                       echo '<li><input type="radio" name="$name" id="$name" onclick="dispCouponByType(\''.$name.'\');" /> '.$name.'</li>';
                            
                                    
                         } ?>
                            
                        </ul>
                   
            </div>
                
            </div>
            <div class="col-sm-4">        
           <div class="btn-group" >
                <button class="btn btn-primary">Filter by Store</button>
                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                            <?php foreach ($resultStores as $name) {
                                 echo '<li><input type="radio" name="$name" id="$name" onclick="dispCoupon(\''.$name.'\');" /> '.$name.'</li>';
                            } ?>
                        </ul>
            </div><br><br>
            
            </div><div class="col-sm-3">
            <div class="btn-group" >
                <button class="btn btn-primary">Filter by coupon categories</button>
                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                            <?php foreach ($resultCategory as $name) {
                                    echo '<li><input type="radio" name="$name" id="$name" onclick="dispCouponByCategory(\''.$name.'\');"/> '.$name.'</li>';
                                    
                            } ?>
                        </ul>
            </div><br><br>
            </div>
        </div>
        <br><br>
         
        
        
            <div class="col-sm-1"></div>
            <br><br><br>    
            <div class="col-sm-12" style="overflow-y: scroll; height: 88vh;" id="CouponDisplay">
                <a href="javascript:void(0);" onclick="downloadCoupon();" class="btn btn-success btn-block" >    Download All the coupons</a> 
<br><br><br>
                    <?php 
                    for($idx = 0;$idx < 60 && $idx < count($resultDetail);$idx++) {
                        $expiry=$resultDetail[$idx]['Expiry'];
                        if($expiry=='')
                                $expiry='Activated Forever';
                        $mycode=$resultDetail[$idx]['CouponCode'];
                        if($mycode=='' or $mycode=='YOUR OWN COUPON')
                                $mycode='Deal Activated';
                                
                    ?>
                    <div class="row">
                        <div class="col-sm-4" style="text-align: left;">
                            Type: <?= $resultDetail[$idx]['CouponType'] ?>
                            
                            
                        </div>
                        <div class="col-sm-5" style="padding-left: 63px;" >
                            <?= "<h2>".$resultDetail[$idx]['Site']."</h2>" ?>
                        </div>
                    </div>
                    
                    <div class="row" style="padding-left: 13px;">
                        <?= $resultDetail[$idx]['Description']; ?>
                    </div><br>
                    
                    <div class="well well-sm" style="padding-left: 450px;"> 
                                       Code: <?= $mycode ?>
                    </div>
                    
                    <div class="row" style="padding-left: 14px;">
                        <?= '<h5>Expiry: '.$expiry.'</h5>'; ?>
                    </div>
                    
                   
                    <b><hr></b>
                    
                    <?php }?>
            </div>
            <div class="col-sm-2"></div>
    </div>
</div>