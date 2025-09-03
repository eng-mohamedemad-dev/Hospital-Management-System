<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\ReviewRequest;
use App\Interfaces\Patient\ReviewInterface;
use App\Models\Review;
use App\Http\Resources\ReviewResource;
use Illuminate\Http\Request;
use App\Models\Doctor;

class ReviewController extends Controller
{
    public function __construct(private ReviewInterface $reviewService)
    {
        $this->middleware('auth:patient');
    }

    public function store(ReviewRequest $request)
    {
       $data = $request->validated();
       $data['patient_id'] = auth()->id();
        $review = $this->reviewService->createReview($data);
        if(!$review){
            return $this->error('Review not created');
        }
        return $this->success('Review created successfully', new ReviewResource($review));
    }

    public function index(Doctor $doctor)
    {
        $reviews = $this->reviewService->getReviews($doctor);
        if(!$reviews){
            return $this->error('No reviews found');
        }
        return $this->success('Reviews fetched successfully', ReviewResource::collection($reviews));
    }

    public function show(Review $review)
    {
        $review = $this->reviewService->getReview($review);
        return $this->success('Review fetched successfully', new ReviewResource($review));
    }

    public function update(ReviewRequest $request, Review $review)
    {
        $review = $this->reviewService->updateReview($request->validated(), $review);
        if(!$review){
            return $this->error('You are not authorized to update this review');
        }
        return $this->success('Review updated successfully', new ReviewResource($review));
    }

    public function destroy(Review $review)
    {
        $review = $this->reviewService->deleteReview($review);
        if(!$review){
            return $this->error('You are not authorized to delete this review');
        }
        return $this->success('Review deleted successfully','');
    }
}
