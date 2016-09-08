#include <stdio.h>
//the main function draw the picture
void getWordsLength(){
	
}


main(){
	int c;
	int wn = 0;
	int wlen[20];
	while((c = getchar()) != EOF){
		if(c == ' ' || c == '\t' || c == '\n'){
			wlen[wn] = 0;
			++wn;
		//	printf("the word number %d is length",wn);
		}else{
			//printf("the word is %d and the no is %d \n", c,wn);
			++wlen[wn];
			printf("the word is %d and the no is %d and the len is %d\n", c,wn,wlen[wn]);
		}
	}
	printf("\n");
	printf("the first word length: %d\t",wlen[0]);
	printf("the second word length: %d\t",wlen[1]);
	printf("get the words number is %d\n",wn);
	int i;
	for(i = 0; i < 5;i++){
		printf("%d\t",wlen[i]);
	}
}
