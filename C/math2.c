#include <stdio.h>
main(){
	float farh;
	int upper,lower,stepi,celsius;
	upper = 300;
	lower = 0;
	celsius = lower;
	while(farh <= upper){
		//farh = (celsius + 32) * 9 / 5;
		farh = (9.0 * celsius) / 5.0 + 32;
		printf("%6.1f\t%d\n",farh,celsius);
		celsius = celsius + 20;
	}
}
