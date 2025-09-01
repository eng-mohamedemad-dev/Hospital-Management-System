<?php

namespace App\Interfaces\Patient;

interface ReviewInterface
{
    public function createReview($data);
    public function getReviews($doctor);
    public function getReview($review);
    public function updateReview($data , $review);
    public function deleteReview($review);
}
