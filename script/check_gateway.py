import os
import time
import requests

# 本脚本通过自动检测路由器的状态，判断办公室电力情况，而做出自动关闭服务器的行为

# 配置
GATEWAY_IP = "192.168.2.1"  # 替换为您的网关 IP 地址
MAX_ATTEMPTS = 5
SLEEP_INTERVAL = 180  # 每次尝试之间的间隔（秒），15分钟内5次尝试，每次间隔180秒
FAIL_COUNT = 0
WEBHOOK_URL = "https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=9393241f-05b6-45a2-a3e7-b3ab5275cf09"  #企业微信群消息

def ping_gateway(ip):
    # 使用 ping 命令检查网关是否可用
    response = os.system(f"ping -c 1 {ip} > /dev/null 2>&1")
    return response == 0

def send_notification(message):
    # 向 Webhook 发送通知
    payload = {
        "msgtype": "text",
        "text": {
            "content": message
        }
    }
    response = requests.post(WEBHOOK_URL, json=payload)
    if response.status_code == 200:
        print("Notification sent successfully.")
    else:
        print("Failed to send notification:", response.text)

def shutdown_all_vms():
    # 获取所有虚拟机 ID 并关闭它们
    print("Shutting down all running VMs...")
    # 使用 shell 命令获取所有运行中的虚拟机 ID
    result = os.popen("qm list | awk '/running/ {print $1}'").read().strip().split()
    
    for vmid in result:
        print(f"Shutting down VM {vmid}...")
        os.system(f"qm shutdown {vmid}")

    # 关闭自身
    print("Shutting down the Proxmox host...")
    os.system("shutdown now")

if __name__ == "__main__":
    for attempt in range(1, MAX_ATTEMPTS + 1):
        if not ping_gateway(GATEWAY_IP):
            print(f"Attempt {attempt}: No response from {GATEWAY_IP}")
            FAIL_COUNT += 1
        else:
            print(f"Attempt {attempt}: {GATEWAY_IP} is reachable")
            exit(0)  # 如果有响应，退出脚本

        time.sleep(SLEEP_INTERVAL)

    if FAIL_COUNT == MAX_ATTEMPTS:
        print(f"Gateway {GATEWAY_IP} is unreachable after {MAX_ATTEMPTS} attempts.")
        # 发送通知，包含 SLEEP_INTERVAL 的值
        send_notification(f"Gateway {GATEWAY_IP} is unreachable after {MAX_ATTEMPTS} attempts. Each attempt waited for {SLEEP_INTERVAL} seconds. The power may be out, so will shutdow inner Delll server")
        
        # 关闭所有虚拟机
        shutdown_all_vms()