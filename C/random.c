/*
 * File name : random.c
 * Author: limingxiao
 * Mail:896113614@qq.com
 * Create Time: 2016-09-06
 * */
#include <stdio.h>
#include <stdlib.h>
#define N 100 
#define C 100
#define UPPER 10

int a[N];
int historgam[C];
void get_random(int upper_bound){
	int i;
	srand(time(NULL));
	for(i = 0;i<N;i++)
		a[i] = rand() % upper_bound;
}

int get_max(int a[],int num){
	int i;
	int max;
	max = a[0];
	for(i = 1;i<num;i++)
		if(max < a[i])
			max = a[i];
	return max;
}

void print_random(){
	int i,j,m;
	m = get_max(&historgam,N);
	int temp[N];
	printf("max is  %d\n",m);
	for(i = 0;i<UPPER;i++)
		printf("%d\t",i);
		printf("\n");
		printf("\n");
	for(i = 0;i<m;i++){
		for(j = 0;j<N;j++){
			if(temp[j] > 0)
				printf("*");
			printf("\t");
		temp[j]--;
		}
		printf("\n");
	}
}

void get_count(){
	int i = 0;
	for(i = 0;i<N;i++)
		historgam[a[i]]++;
}

int main(void){
	get_random(UPPER);
	get_count();
	printf("value \thowmany \n");
	for(i = 0;i < UPPER;i++)
		printf("%d\t%d\n",i,10);
	print_random();
	return 0;
}
