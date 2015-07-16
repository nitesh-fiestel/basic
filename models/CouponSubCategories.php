<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CouponSubCategories".
 *
 * @property integer $SubCategoryID
 * @property integer $CategoryID
 * @property string $Name
 * @property string $URL
 * @property string $Title
 * @property string $MetaDescription
 * @property integer $NumActiveCoupons
 * @property double $SubCategoryPopularityScore
 */
class CouponSubCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CouponSubCategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CategoryID', 'URL', 'MetaDescription'], 'required'],
            [['CategoryID', 'NumActiveCoupons'], 'integer'],
            [['Title', 'MetaDescription'], 'string'],
            [['SubCategoryPopularityScore'], 'number'],
            [['Name', 'URL'], 'string', 'max' => 200],
            [['Name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SubCategoryID' => 'Sub Category ID',
            'CategoryID' => 'Category ID',
            'Name' => 'Name',
            'URL' => 'Url',
            'Title' => 'Title',
            'MetaDescription' => 'Meta Description',
            'NumActiveCoupons' => 'Num Active Coupons',
            'SubCategoryPopularityScore' => 'Sub Category Popularity Score',
        ];
    }
}
