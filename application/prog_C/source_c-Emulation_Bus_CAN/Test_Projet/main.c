#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <winsock2.h>
#include "vs_can_api.h"



int main(int argc, char* argv[])
{
VSCAN_STATUS status;
VSCAN_HANDLE handle;
VSCAN_MSG msgs[8];
DWORD written;
msgs[0].Flags = VSCAN_FLAGS_EXTENDED;
msgs[0].Size = 8;
char* byte[8];
int i;

WSADATA WSAData;
SOCKET sock;
SOCKADDR_IN sin;
WSAStartup(MAKEWORD(2,0), &WSAData);
char buffer[100];
char* ok="READY";
int port;

port=(int)strtol(argv[argc-1], NULL, 16);
sock = socket(AF_INET,SOCK_STREAM,0);
sin.sin_addr.s_addr	= inet_addr("127.0.0.1");
sin.sin_family		= AF_INET;
sin.sin_port		= htons(port);

bind(sock, (SOCKADDR *)&sin, sizeof(sin));

connect(sock, (SOCKADDR *)&sin, sizeof(sin));
send(sock, "READY", sizeof("READY"), 0);

do
{
recv(sock, buffer, sizeof(buffer), 0);
}while(strcmp(buffer, ok)!=1);

for (i=1;i<argc-1;i++)
{
    byte[i-1] = argv[i];
}
msgs[0].Id= (UINT32)strtol(argv[argc-2], NULL, 16);


for(i=0;i<8;i++)
{
    msgs[0].Data[7-i] = (UINT8)strtol(byte[i], NULL, 16);
}

handle = VSCAN_Open("192.168.254.254:2001",VSCAN_MODE_NORMAL);

printf("%x\n", msgs[0].Size);

for(i=0;i<20240;i++)
{
    status = VSCAN_Write(handle, msgs, 1, &written);
}

for(i=0;i<8;i++)
{
    printf("%x\n",msgs[0].Data[i]);
}

switch(status)
{
    case VSCAN_ERR_OK : printf("Everything is okay\n");
                        break;

    case VSCAN_ERR_ERR : printf("General error\n");
                         break;

    case VSCAN_ERR_NO_DEVICE_FOUND : printf("No CAN device was found with specific function\n");
                                     break;

    case VSCAN_ERR_SUBAPI : printf("Error in subordinated library\n");
                            break;

    case VSCAN_ERR_NOT_ENOUGH_MEMORY : printf("Not enough memory\n");
                                       break;

    case VSCAN_ERR_NO_ELEMENT_FOUND : printf("No request element available\n");
                                      break;

    case VSCAN_ERR_INVALID_HANDLE : printf("Invalid handle\n");
                                    break;

    case VSCAN_ERR_IOCTL : printf("Ioctl request failed\n");
                           break;

    case VSCAN_ERR_MUTEX : printf("Problem with a used mutex in CAN API\n");
                           break;

    case VSCAN_ERR_CMD : printf("Problem to complete a given command\n");
                         break;
}

status = VSCAN_Close(handle);
WSACleanup();
return 0;
}




