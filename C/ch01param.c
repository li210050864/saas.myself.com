#include <stdio.h>
#define MAXLINE 1000

/*
 * 声明获取一行的文本，
 * char s[] 用于存放一行字符串，类型为字符数组，这个字符数组中存放的是一行字符串
 * int lim 字符数组的最大的存储字符的个数
*/
int mgetline(char s[],int lim);

/*
* 一行字符串的拷贝，将目前最长的一行字符串拷贝保存下来
*/
void copy(char to[],char from[]);

main(){
	int len;
	int max;
	char line[MAXLINE];
	char longest[MAXLINE];

	while((len = mgetline(line,MAXLINE) > 0)){
		if(len > max){
			max = len;
			copy(longest,line);
		}
	}
	if(max > 0){
		printf("%s",longest);
	}
	return 0;
}
/*
* '\0' 表示字符串的结束字符
*/
int mgetline(char s[],int lim){
	int i;
	for(i = 0;i<lim -1 && (c = getchar())!= EOF && c != "\n")
		s[i] = c;
	if(c == "\n"){
		s[i] = c;
		++i;
	}
	s[i] = '\0';
	return i;
}

void copy(char to[] , char from[]){
	int i = 0;
	while((to[i] = from[i]) != "\0")
		++i;
}