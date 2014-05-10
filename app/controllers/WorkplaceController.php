<?php

class WorkplaceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$skip = Input::get('skip');

		$r = DB::table( 'D3_Viz_data' )
			->select( 'x', 'y', 'r', 'label' )
			->where( 'Name', "co2saved" )
			->get();
			
		return Response::json( $r );
		
		
		
		
		echo '<pre>';
		var_dump($r);
		echo '</pre>';
		die();

		$response = [];
		
		$p_count = [];
		
		$km = $this->getKm();
			
		$p_count = DB::table('registrant')
			->join( 'workplace', 'registrant.workplace_id', '=', 'workplace.workplace_id' )
			->select( DB::raw('count(registrant.registrant_id) as y, workplace.workplace_id as id') )
			->groupBy( 'workplace_name' )
			->take( 50 )
			->get();
			
		foreach( $p_count as $p ) {
			if( !isset( $km[$p->id] ) ) {
				$km[$p->id] = new stdClass();
			}
			if( isset( $km[$p->id]->workplace_headcount ) && $km[$p->id]->workplace_headcount != 0 ) {
				$km[$p->id]->y = $p->y / $km[$p->id]->workplace_headcount;
				unset( $km[$p->id]->workplace_headcount );
			} else {
				$km[$p->id]->y = 0;
			}
			unset( $km->id );
		}
		
		$response = $km;
				
		return Response::json($response);
	}

	private function getKm()
	{
		$kms = DB::table('commute')
			->join( 'registrant', 'registrant.registrant_id', '=', 'commute.registrant_id' )
			->join( 'workplace', 'registrant.workplace_id', '=', 'workplace.workplace_id' )
			->select( DB::raw('sum(commute.distance_km) as x, workplace_name as label, workplace_headcount, workplace_headcount as r, workplace.workplace_id as id') )
			->groupBy( 'workplace_name' )
			->take( 50 )
			->get();
			
		$a = [];
		foreach( $kms as $km ) {
			$a[$km->id] = $km;
		}
		
		return $a;		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$workplace = Workplace::find($id);
		
		$response = $workplace->stats();
		
		return Response::json( $response );
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
