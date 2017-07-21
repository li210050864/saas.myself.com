#include <stdio.h>
#define LOWER 0
#define UPPER 300
#define STEP 20


int power(int m,int n);

float temperature(int celsius);


main(){
	int i;
	for(i=0;i<10;++i)
		printf("%d %d %d \n",i,power(2,i),power(3,i));

	int celsius;
	for(celsius = LOWER;celsius <= UPPER;celsius = celsius+20)
		printf("%d %6.1f \n",celsius,temperature(celsius));
	return 0;
}

int power(int base,int n){
	int i,p;
	p = 1;
	for(i=1;i<=n;++i)
		p = p * base;
	return p;
}

float temperature(int celsius){
	float farh;
	farh = (5.0/9.0) * (celsius - 32);
	return farh;
}
