<?php

class Workplace extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'workplace';
	
	protected $primaryKey = 'workplace_id';
	
	public function stats() {
		
		$participants = Registrant::where('workplace_id', $this->workplace_id)->get();
		
		$count = $participants->count();
		
		$percent_participation = 0;
		
		if( $this->workplace_headcount != 0 ) {
			$percent_participation = $count / $this->workplace_headcount;
		}
		
		$km = 0;
		
		$km = DB::table('commute')
			->join( 'registrant', 'registrant.registrant_id', '=', 'commute.registrant_id' )
			->join( 'workplace', 'registrant.workplace_id', '=', 'workplace.workplace_id' )
			->select( DB::raw('sum(commute.distance_km) as km, workplace_name, workplace_headcount') )
/* 			->where( 'workplace.workplace_id', $this->workplace_id ) */
			->get();
			
	

/* 		Log::error( '>> workplace '.$this->workplace_id.': '.$km.' km total' ); */
		
/*
		foreach( $participants as $particpant )
		{
			
			$commutes = Commute::where('registrant_id', $particpant->registrant_id)->get();
			foreach( $commutes as $commute ) {
				$km += $commute->distance_km;
			}
		}
*/
		
		$response = 
		[
			[
				'x' => $km,
				'y' => $percent_participation,
				'r' => $this->workplace_headcount,
				'label' => $this->workplace_name
			]
		];
		
		return $response;
		
	}

}