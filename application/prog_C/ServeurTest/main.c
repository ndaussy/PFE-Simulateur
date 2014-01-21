
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <winsock2.h>

int main()//serveur
{

 WSADATA WSAData;
 WSAStartup(MAKEWORD(2,2), &WSAData);

SOCKET sock = socket(AF_INET, SOCK_DGRAM, 0);

char buffer[100];
int n;




SOCKADDR_IN sin = { 0 };

sin.sin_addr.s_addr = htonl(INADDR_ANY);

sin.sin_family = AF_INET;

sin.sin_port = htons(4150);

bind (sock, (SOCKADDR *) &sin, sizeof sin);

struct hostent *hostinfo = NULL;

SOCKADDR_IN from = { 0 };

int fromsize = sizeof from;

if((n = recvfrom(sock, buffer, sizeof(buffer)- 1, 0, (SOCKADDR *)&from, &fromsize)) < 0)
{
    printf("WSAGetLastError recvfrom() : %d\n", WSAGetLastError());
    exit(0);
}



buffer[n] = '\0';

/* traitement */
printf("%s",buffer);
char *ok="Ready"

if(sendto(sock, ok,strlen(ok), 0, (SOCKADDR *)&from, fromsize) < 0)
{
    printf("WSAGetLastError sendto() : %d\n", WSAGetLastError());
    exit(0);
}


closesocket(sock);
 WSACleanup();
return 0;
}
