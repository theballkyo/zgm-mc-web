<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Illuminate\Http\Request;

class TopicController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth', ['except' => [
			'index',
			'show',
		]]);
	}

	/**
	 * Show all topics
	 *
	 * @return Response
	 */
	public function index() {
		$topics = App\Topic::with('user', 'category')->orderBy('status', 'desc')->orderBy('updated_at', 'desc')->active()->get();
		$category = App\Category::all();

		return view('topic.index', ['topics' => $topics, 'category' => $category]);
	}

	/**
	 * Show the topic
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function show(Request $request, $id) {
		$topic = App\Topic::with('comment', 'comment.user')->where('id', $id)->first();

		if (empty($topic) || ($topic->status == -1)) {
			if (Auth::guest() || !Auth::user()->is_admin()) {
				return view('errors.topic404');
			}
		}

		return view('topic.show', ['topic' => $topic]);
	}

	/**
	 * Show create topic page
	 *
	 * @return Response
	 */
	public function create() {
		$category = App\Category::all();
		return view('topic.create', ['category' => $category]);
	}

	/**
	 * Store the topic
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'title' => 'required|max:128|min:12',
			'body' => 'required|min:32',
			'category' => 'required|exists:category,id',
		], [
			'title.*' => 'หัวข้อต้องมีความยาว 12-128 ตัวอักษร',
			'body.*' => 'เนื้อหาต้องมีความยาวไม่น้อยกว่า 32 ตัวอักษร',
			'category.*' => 'กรุณาเลือกหมวดหมู่ด้วย',
		]);

		$topic = new App\Topic;

		$topic->title = $request->title;
		$topic->body = clean($request->body);
		$topic->user_id = $request->user()->id;
		$topic->category_id = $request->category;

		$topic->save();

		return redirect()->action('TopicController@show', ['id' => $topic->id]);
	}

	/**
	 * Redirect reply if not have ID topic to reply
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function replyRedirect(Request $request) {
		return redirect()->action('TopicController@index');
	}

	/**
	 * Show reply page
	 *
	 * @param  Request  $Request
	 * @param  int      $id
	 * @return Response
	 */
	public function reply(Request $request, $id) {
		$topic = App\Topic::find($id);

		if (empty($topic)) {
			return view('topic.notFound');
		}

		return view('topic.reply', ['topic' => $topic]);
	}

	/**
	 * Store reply of topic
	 *
	 * @param  Request  $Request
	 * @return Response
	 */
	public function storeReply(Request $request) {
		$this->validate($request, [
			'body' => 'required|min:8|max:512',
			'id' => 'required',
		], [
			'body.*' => 'เนื้อหาต้องมีความยาว 8-512 ตัวอักษร',
		]);

		$topic = App\Topic::find($request->id);

		if (empty($topic)) {
			return view('topic.notFound');
		}

		if (!$topic->canReply()) {
			return redirect()->action('TopicController@show', ['id' => $topic->id]);
		}

		$comment = new App\Comment;

		$comment->user_id = $request->user()->id;
		$comment->body = clean($request->body);
		$comment->topic_id = $topic->id;

		$comment->save();

		return redirect()->action('TopicController@show', ['id' => $topic->id]);
	}

	/**
	 * Show edit topic page
	 *
	 * @param  Request  $Request
	 * @param  Int      $id
	 * @return Response
	 */
	public function edit(Request $request, $id) {
		$topic = App\Topic::find($id);

		if (empty($topic)) {
			return view('topic.notFound');
		}

		if (!$topic->canEdit()) {
			return redirect()->action('TopicController@show', ['id' => $topic->id]);
		}

		return view('topic.edit', ['topic' => $topic]);
	}

	/**
	 * Update the topic
	 *
	 * @param  Request  $request
	 * @param Int      $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$this->validate($request, [
			'title' => 'required|max:128|min:12',
			'body' => 'required|min:32',
		], [
			'title.*' => 'หัวข้อต้องมีความยาว 12-128 ตัวอักษร',
			'body.*' => 'เนื้อหาต้องมีความยาวไม่น้อยกว่า 32 ตัวอักษร',
		]);

		$topic = App\Topic::find($id);

		if (empty($topic)) {
			return view('topic.notFound');
		}

		if (!$topic->canEdit()) {
			return redirect()->action('TopicController@show', ['id' => $topic->id]);
		}

		$topic->title = $request->title;
		$topic->body = clean($request->body);

		$topic->save();

		return redirect()->action('TopicController@show', ['id' => $topic->id]);
	}

	/**
	 * Show confirm delete topic page
	 *
	 * @param  Request  $request
	 * @param  Int      $id
	 * @return Response
	 */
	public function deleteConfirm(Request $request, $id) {
		$topic = App\Topic::find($id);

		if (empty($topic)) {
			return view('topic.notFound');
		}

		if (!$topic->canEdit()) {
			return redirect()->action('TopicController@show', ['id' => $topic->id]);
		}

		return view('topic.delete', ['topic' => $topic]);
	}

	/**
	 * Remove topic
	 *
	 * @param  Request  $request
	 * @param  Int      $id
	 * @return Response
	 */
	public function destroy(Request $request, $id) {
		$topic = App\Topic::find($id);

		if (empty($topic)) {
			return view('topic.notFound');
		}

		if (!$topic->canEdit()) {
			return redirect()->action('TopicController@show', ['id' => $topic->id]);
		}

		$topic->setBan();

		$topic->save();

		return redirect()->action('TopicController@index');
	}

	/**
	 * Toggle pin topic
	 *
	 * @param  Request  $request
	 * @param  Int      $id
	 * @return Response
	 */
	public function pin(Request $request, $id) {
		$topic = App\Topic::find($id);

		if (empty($topic)) {
			return view('topic.notFound');
		}

		if (!$topic->canEdit()) {
			return redirect()->action('TopicController@show', ['id' => $topic->id]);
		}

		$topic->togglePin();

		$topic->save();

		return redirect()->action('TopicController@show', ['id' => $topic->id]);
	}

	/**
	 * Toggle lock topic
	 *
	 * @param  Request  $request
	 * @param  Int      $id
	 * @return Response
	 */
	public function lock(Request $request, $id) {
		$topic = App\Topic::find($id);

		if (empty($topic)) {
			return view('topic.notFound');
		}

		if (!$topic->canEdit()) {
			return redirect()->action('TopicController@show', ['id' => $topic->id]);
		}

		$topic->toggleLock();

		$topic->save();

		return redirect()->action('TopicController@show', ['id' => $topic->id]);
	}

}
