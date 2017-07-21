#include <stdio.h>
#define LINECOUNT 10
#define MAXLINE 1000

int mgetline(char line[],int maxline);

void copy(char to[],char from[]);

main(){
	int len;
	int max;
	char line[MAXLINE];
	char longest[MAXLINE];
	
	while((len = mgetline(line,MAXLINE)) > 0){
		if(len > LINECOUNT){
			copy(longest,line);
			printf("%s",longest);
		}
	}
	return 0;
}

int mgetline(char s[], int lim){
	int c,i;
	for(i = 0; i < lim -1 && (c = getchar())!= EOF && c != '\n';++i)
		s[i] = c;
	if(c == '\n'){
		s[i] = c;
		++i;
	}
	s[i] = '\0';
	return i;
}

void copy(char to[],char from[]){
	int i;
	i = 0;
	while((to[i] = from[i]) != '\0')
		++i;
}
