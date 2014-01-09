#include <stdio.h>
#include <stdlib.h>

int main(int argc, char *argv[])
{
	int a=0;

	for(a = 0 ; a < argc ; a++)
	{
    printf("Argument envoyé %s \n",(char*)argv[a]);
	}

	if(argc>1)
	{
		return 0;
	}
	else
	{

		return 1;	
	}

    
}