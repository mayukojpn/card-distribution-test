<?php
/*
a. Spade = S, Heart = H, Diamond = D, Club = C
b. Card 2 to 9 are, as it is, 1=A,10=X,11=J,12=Q,13=K
c. The card distributed to the first person on the first row will be separated (comma),
d. The card distributed to the second person on the second row will be separated(comma),
*/

class Card {

	protected $cards   = [];
	private   $numbers = [];
	private   $suits   = ['S', 'H', 'D', 'C'];
	protected $players = '';

	public function __construct() {

		if(!isset($_POST['players'])){
			echo "Irregularity occurred";
			//return;
		}
		$this->players =  (int) $_POST['players'];

		$this->arrange_numbers();
		$this->arrange_cards();
		$this->distribute_cards();

	}
	private function arrange_numbers() {
		$this->numbers = array_merge(
			['A'],
			range(2,9),
			['X', 'J', 'Q', 'K']
		);
	}
	private function arrange_cards() {
		foreach( $this->suits as $suit ) {
			foreach( $this->numbers as $number ) {
				$this->cards[] = $suit . '-' . $number;
			}
		}
		shuffle($this->cards);
	}
	private function distribute_cards() {

		$hands   = [];
		$output = "";

		/*
		while ( $this->players >= count($this->cards) ){
			$this->arrange_cards();
		}
		*/

		while ( $this->cards ) {
			$count = 0;
			while ( $count <= $this->players -1 ) {
				if ( $this->cards ) {
					$hands[$count] = $hands[$count] . array_shift($this->cards) . ", ";
				}
				else {
					$hands[$count] = $hands[$count] . " ";
				}
				$count++;
			}
		}

		foreach ( $hands as $hand ) {
			$output = $output . "<li>" . $hand . "</li>";
		}
		$output = "<ol>" . $output . "</ol>";
		echo $output;
	}
}
new Card();
