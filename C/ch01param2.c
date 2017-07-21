#include <stdio.h>
#define LINECOUNT 80
#define MAXLINE 1000

int mgetline(char line[], int maxline);

void copy(char to[],char from[]);

main(){
	int len;
	char line[MAXLINE];
	char longest[MAXLINE];

	while((len = mgetline(line,MAXLINE)) > 0){
		if(len > LINECOUNT){
			// copy(longest,line);
			// printf("%s\n", longest);
			printf("%s\n",line);
		}
	}
	return 0;
}

int mgetline(char line[],int lim){
	int i,c;
	for(i = 0; i< lim -1 && (c = getchar())!= EOF && c != "\n";++i)
		line[i] = c;
	if(c == "\n"){
		line[i] = c;
		++i;
	}
	line[i] = '\0';
	return i;
}	

void copy(char to[],char from[]){
	int i;
	i = 0;
	while((to[i] = from[i]) != '\0')
		i++;
}