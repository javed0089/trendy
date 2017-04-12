<?php

namespace App\Models\Rating;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{


	public function User()
	{
		return $this->belongsTo('App\User');
	}

	public function averageRating()
	{

		return $this;
	}

	public function excellent()
	{
		$totalRatings = $this->count();
		$filteredRatings = $this->where('rating','=','4')->count();
		$RatingsPer = ($filteredRatings/$totalRatings)*100;
		return number_format($RatingsPer,2);
	}

	public function good()
	{
		$totalRatings = $this->count();
		$filteredRatings = $this->where('rating','=','3')->count();
		$RatingsPer = ($filteredRatings/$totalRatings)*100;
		return number_format($RatingsPer,2);
	}

	public function average()
	{
		$totalRatings = $this->count();
		$filteredRatings = $this->where('rating','=','2')->count();
		$RatingsPer = ($filteredRatings/$totalRatings)*100;
		return number_format($RatingsPer,2);
	}

	public function poor()
	{
		$totalRatings = $this->count();
		$filteredRatings = $this->where('rating','=','1')->count();
		$RatingsPer = ($filteredRatings/$totalRatings)*100;
		return number_format($RatingsPer,2);
	}
}
