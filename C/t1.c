#include <stdio.h>
main(){
	int c;
	if((c = getchar()) != EOF){
		printf("not equal!\n");
	}else{
		printf("equal!\n");
	}
}
