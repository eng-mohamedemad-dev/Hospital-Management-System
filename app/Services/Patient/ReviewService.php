<?php

namespace App\Services\Patient;

use App\Interfaces\Patient\ReviewInterface;
use App\Models\Doctor;
use App\Models\Review;

class ReviewService implements ReviewInterface
{
    public function createReview($data)
    {
        $review = Review::create($data);

        // تحديث بيانات الدكتور
        $doctor = Doctor::find($data['doctor_id']);
        $doctor->reviews_count += 1;
        $doctor->reviews_sum += $data['rating'];
        $doctor->reviews_avg = $doctor->reviews_sum / $doctor->reviews_count;
        $doctor->save();

        return $review;
    }

    public function getReviews($doctor)
    {
        return Review::with('doctor', 'patient')->where('doctor_id', $doctor->id)->get();
    }

    public function getReview($review)
    {
        return $review->load('doctor', 'patient');
    }

    public function updateReview($data, $review)
    {
        if($review->patient_id != auth()->id()){
           return false;
        }
        return tap($review,function($review) use ($data){
            if (isset($data['rating'])){
                $doctor = Doctor::find($review->doctor_id);
                $doctor->reviews_sum -= $review->rating;
                $doctor->reviews_sum += $data['rating'];
                $doctor->reviews_avg = $doctor->reviews_sum / $doctor->reviews_count;
                $doctor->save();
            }
            $review->update($data);
        });
    }

    public function deleteReview($review)
    {
        if($review->patient_id != auth()->id()){
            return false;
        }
        $doctor = Doctor::find($review->doctor_id);
        $doctor->reviews_count -= 1;
        $doctor->reviews_sum -= $review->rating;
        $doctor->reviews_avg = $doctor->reviews_sum / $doctor->reviews_count;
        $doctor->save();
        return $review->delete();
    }
}
