<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Http\Requests\PrepareQuoteRequest;
use App\Quote;

use Illuminate\Http\Request;

class QuotesController extends Controller {

	/**
	 * Create new Quote instance and apply middleware for authentication
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show page to edit quotes
	 * 
	 * @return quotes/edit
	 */
	public function edit()
	{
		$quotes = (Auth::user()->quotes) ? Auth::user()->quotes : "";

		return view('quotes/edit', compact('quotes'));
	}

	/**
	 * Store quote, author, or both in DB
	 * 
	 * @param  Request $request 
	 * 
	 * @return /
	 */
	public function store(Request $request)
	{
		if ($request->random)
		{
			$this->checkForQuotes();

			return redirect('/');
		}
		$quote = new Quote;

		$this->checkForQuotes();

		if ($request->quote) $quote->quote = $request->quote;
		if ($request->author) $quote->author = $request->author;

		if ($request->quote || $request->author) Auth::user()->quotes()->save($quote);

		return redirect('/');
	}

	/**
	 * Check if user has quotes and delete if they do
	 */
	public function checkForQuotes()
	{
		if (Auth::user()->quotes()->count() > 0)
		{
			DB::table('quotes')->delete(Auth::user()->user_id);
		}
	}

}
