<?php
namespace app\models;
use Yii;
use app\models\Website;
/*
 */
class Coupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Coupon';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CountSuccess', 'CountFail', 'Hits', 'IsApproved', 'IsFeatured', 'WL_IsOffline', 'WebsiteID', 'AddedByAdmin', 'AdminID', 'EmailSent', 'UseLandingPageOnly', 'HasBeenReviewed', 'Priority', 'IsOneTimeUse', 'OneCodeIssuedPerNumSeconds', 'IsDeal', 'IncludeInAlertEmails', 'Gender', 'PinExpireTime', 'FeaturedCouponRank', 'FeaturedRankUnderMerchant', 'AllowWoSignIn', 'Category', 'Tags', 'SubCategory', 'diwaliScore'], 'integer'],
            [['FeatureStartDate', 'FeatureEndDate', 'LastFeaturedActivityTimestamp', 'DateAdded', 'Expiry', 'DateVerified', 'MakeActiveDate', 'ExclusiveStartDate', 'MerchantFeatureEndTime'], 'safe'],
            [['Discount', 'CouponPopularityScore', 'NewCouponPopularityScore'], 'number'],
            [['Description', 'MobileWebType', 'MobileAppType', 'CouponType', 'FullTerms', 'Status'], 'string'],
            [['AllowWoSignIn'], 'required'],
            [['CouponCode', 'DiscountByValue', 'DiscountByPercentage', 'DiscountByFreeItem'], 'string', 'max' => 100],
            [['Title'], 'string', 'max' => 250],
            [['Link', 'MobileWebUrl', 'CustomMobileWebUrl', 'MobileAppUrl', 'CustomMobileAppUrl', 'MicroSitePartners', 'APIClients'], 'string', 'max' => 1000],
            [['IP'], 'string', 'max' => 20]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CouponID' => 'Coupon ID',
            'CouponCode' => 'Coupon Code',
            'CountSuccess' => 'Count Success',
            'CountFail' => 'Count Fail',
            'Hits' => 'Hits',
            'IsApproved' => 'Is Approved',
            'IsFeatured' => 'Is Featured',
            'WL_IsOffline' => 'Wl  Is Offline',
            'FeatureStartDate' => 'Feature Start Date',
            'FeatureEndDate' => 'Feature End Date',
            'LastFeaturedActivityTimestamp' => 'Last Featured Activity Timestamp',
            'DateAdded' => 'Date Added',
            'Discount' => 'Discount',
            'Title' => 'Title',
            'Description' => 'Description',
            'WebsiteID' => 'Website ID',
            'Expiry' => 'Expiry',
            'DateVerified' => 'Date Verified',
            'AddedByAdmin' => 'Added By Admin',
            'AdminID' => 'Admin ID',
            'EmailSent' => 'Email Sent',
            'UseLandingPageOnly' => 'Use Landing Page Only',
            'Link' => 'Link',
            'MobileWebType' => 'Mobile Web Type',
            'MobileWebUrl' => 'Mobile Web Url',
            'CustomMobileWebUrl' => 'Custom Mobile Web Url',
            'MobileAppType' => 'Mobile App Type',
            'MobileAppUrl' => 'Mobile App Url',
            'CustomMobileAppUrl' => 'Custom Mobile App Url',
            'IP' => 'Ip',
            'HasBeenReviewed' => 'Has Been Reviewed',
            'Priority' => 'Priority',
            'IsOneTimeUse' => 'Is One Time Use',
            'CouponType' => 'Coupon Type',
            'OneCodeIssuedPerNumSeconds' => 'One Code Issued Per Num Seconds',
            'IsDeal' => 'Is Deal',
            'IncludeInAlertEmails' => 'Include In Alert Emails',
            'Gender' => 'Gender',
            'MakeActiveDate' => 'Make Active Date',
            'CouponPopularityScore' => 'Coupon Popularity Score',
            'ExclusiveStartDate' => 'Exclusive Start Date',
            'PinExpireTime' => 'Pin Expire Time',
            'FullTerms' => 'Full Terms',
            'FeaturedCouponRank' => 'Featured Coupon Rank',
            'FeaturedRankUnderMerchant' => 'Featured Rank Under Merchant',
            'MerchantFeatureEndTime' => 'Merchant Feature End Time',
            'MicroSitePartners' => 'Micro Site Partners',
            'AllowWoSignIn' => 'Allow Wo Sign In',
            'APIClients' => 'Apiclients',
            'DiscountByValue' => 'Discount By Value',
            'DiscountByPercentage' => 'Discount By Percentage',
            'DiscountByFreeItem' => 'Discount By Free Item',
            'Category' => 'Category',
            'Tags' => 'Tags',
            'SubCategory' => 'Sub Category',
            'diwaliScore' => 'Diwali Score',
            'Status' => 'Status',
            'NewCouponPopularityScore' => 'New Coupon Popularity Score',
        ];
    }
    
    // this function prints the type of coupons
    function couponType() {
        $result = Coupon::find()
                ->orderBy('CouponType')
                ->distinct(true)
                ->select('CouponType')
                ->limit(10)
                ->all();
        $myarray = array();
        $i = 0;
        foreach ($result as $value) {
            $myarray[$i++] = $value->CouponType;
        }
        return $myarray;
    }
    
    // get the details of all the coupons
    function couponDetail() {
        $query = (new \yii\db\Query())
                ->from('Coupon')
                ->innerJoin('Website', 'Coupon.WebsiteID = Website.WebsiteID')
                ->select('CouponType, Website.WebsiteName AS Site, Coupon.Description AS Description, Expiry, CouponCode, WebsiteURL AS url')
                ->orderBy('CountSuccess DESC')
                ->limit(60)
                ->all();
        
        
       return $query;
    }
    
    // get a result array of top coupons by Store name
    function couponDetailBySite($site) {
        $query = (new \yii\db\Query())
                ->from('Coupon')
                ->innerJoin('Website', 'Coupon.WebsiteID = Website.WebsiteID')
                ->select('CouponType, Website.WebsiteName AS Site, Coupon.Description AS Description, Coupon.Expiry AS Expiry, CouponCode, WebsiteURL AS url')
                ->where(['Website.WebsiteName' => $site])
                ->orderBy('CountSuccess DESC')
                ->limit(60)
                ->all();
        return $query;
    }
    
    // get a result array of top coupons by category
    function couponDetailByCategory($cat) {
        $query = (new \yii\db\Query())
                ->from('Coupon')
                ->innerJoin('Website', 'Coupon.WebsiteID = Website.WebsiteID')
                ->select('CouponType, Website.WebsiteName AS Site, Coupon.Description AS Description, Coupon.Expiry AS Expiry, CouponCode, WebsiteURL AS url')
                ->where("CouponID IN (SELECT CouponID FROM CouponCategoryInfo WHERE CategoryID=(Select CategoryID from CouponCategories where Name='".$cat."'))")
                ->orderBy('CountSuccess DESC')
                ->limit(60)
                ->all();
        return $query;
    }
    
    // get a result array of top coupons by coupon type
    function couponDetailByType($type) {
        $query = (new \yii\db\Query())
                ->from('Coupon')
                ->innerJoin('Website', 'Coupon.WebsiteID = Website.WebsiteID')
                ->select('CouponType, Website.WebsiteName AS Site, Coupon.Description AS Description, Coupon.Expiry AS Expiry, CouponCode, WebsiteURL AS url')
                ->where(['CouponType' => $type])
                ->orderBy('CountSuccess DESC')
                ->limit(60)
                ->all();
        return $query;
    }
    
}