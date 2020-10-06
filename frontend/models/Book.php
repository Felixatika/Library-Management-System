<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $bookId
 * @property string $bookName
 * @property string $referenceNo
 * @property string $publisher
 * @property int $status status 0 available book,status 1 represent issued book,status 2 represent pending
 *
 * @property BookAuthor[] $bookAuthors
 * @property BorrowedBook[] $borrowedBooks
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bookName', 'referenceNo', 'publisher'], 'required'],
            [['status'], 'integer'],
            [['bookName'], 'string', 'max' => 100],
            [['referenceNo', 'publisher'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bookId' => 'Book ID',
            'bookName' => 'Book Name',
            'referenceNo' => 'Reference No',
            'publisher' => 'Publisher',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['bookId' => 'bookId']);
    }

    /**
     * Gets query for [[BorrowedBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowedBooks()
    {
        return $this->hasMany(BorrowedBook::className(), ['bookId' => 'bookId']);
    }
}
