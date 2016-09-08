#include <stdio.h>
#define LOWER 0
#define UPPER 300
#define STEP 20
/**
 * 计算整数 m 的 n 次幂， n 为整数
*/
int prower(int m,int n);
/*
 * 华氏温度和摄氏温度之间的转换
*/
float temperature(int celsius);


main(){
	// 整数m 的n次幂的测试
	int i;
	for(i = 0;i < 10;++i)
		printf("%d %d %d \n",i,prower(2,i),prower(3,i));

	// 温度转换函数的测试
	int celsius;
	for(celsius = LOWER;celsius <= UPPER;celsius = celsius + STEP)
		printf("%d %f \n",celsius,temperature(celsius));
	
	return 0;
}

int prower(int base,int n){
	int i,p;
	for(i = 1;i <= n; ++i)
		p = p * base;
	return p;
}
float temperature(int celsius){
	float farh;
	farh = (5.0/9.0) * (celsius - 32);
	return farh;
}