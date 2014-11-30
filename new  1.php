リレーション：データベースにおけるテーブル同士の関係。主に1対1、1対多、多対多の三つがある。
	1対1
	・AモデルがBモデルを持つ
	class A extends Eloquent {
		public function B(){
			return $this->hasOne('B');
		}
	}
	・BモデルがAモデルに属する
	class B extends Eloquent {
		public function A(){
			return $this->belongsTo('A');
		}
	}
	
	1対多
	・Aモデルが沢山のBモデルを持つ
	class A extends Eloquent {
		public function B(){
			return $this->hasMany('Bs');
		}
	}
	・沢山のBモデルがAモデルに属する
	class B extends Eloquent {
		public function A(){
			return $this->belongsTo('A');
		}
	}
	
	多対多
	・沢山のAモデルが沢山のBモデルを持つ（沢山のBモデルが沢山のAモデルに属する）
	belongsToの引数は順に(相手のモデル、ピボットテーブルC、Aのキー、Bのキー)で、第3，4引数はオーバーライドするため
	class A extends Eloquent {
		public functionB(){
			return $this->belongsToMany('B', 'C', 'a', 'b');
		}
 
	}