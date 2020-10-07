<?php

namespace frontend\models;
use frontend\models\Borrowedbook;

use Yii;

/**
 * This is the model class for table "borrowedbook".
 *
 * @property int $bbId
 * @property int $studentId
 * @property int $bookId
 * @property string $borrowDate
 * @property string $expectedReturnDate
 * @property string|null $actualReturnDate
 * @property Student $student
 * @property Book $book
 */
class Borrowedbook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'borrowedbook';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['studentId', 'bookId', 'borrowDate', 'expectedReturnDate'], 'required'],
            [['studentId', 'bookId'], 'integer'],
            [['borrowDate', 'expectedReturnDate', 'actualReturnDate'], 'safe'],
            [['studentId'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['studentId' => 'studentsId']],
            [['bookId'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['bookId' => 'bookId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bbId' => 'Bb ID',
            'studentId' => 'Student ID',
            'bookId' => 'Book ID',
            'borrowDate' => 'Borrow Date',
            'expectedReturnDate' => 'Expected Return Date',
            'actualReturnDate' => 'Actual Return Date',
        ];
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['studentsId' => 'studentId']);
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['bookId' => 'bookId']);
    }
}
