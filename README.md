# **Coatl**
Multiple different simulated malware files for testing your friends, employees or colleagues cyber security skill. 

# HCoatl.bat
The most obvious one of the bunch, Hitchhiker Coatl is just scare-ware(and very bad scare-ware at that), will pretty much only work on the people worst at cyber security.
1. Will tell the user it exists with a large and very demanding CMD window
2. Checks if it was run with admin privelages, if not it requests admin
3. Allows outbound FTP traffic for network crawling
4. Checks if the change was successful
5. Allows outbound SMB traffic for network crawling
6. Checks if the change was successful
7. Gets the Downloads path via Reg Queries
8. Moves itself to downloads folder for easy cleanup
9. Creates SystemSettings.bat in the Startup dir
10. Creates a list of FTP commands and saves them to a txt for network crawling
11. Gets the LAN IP address
12. Enumerates LAN IP for devices that have FTP open
13. Sends itself to all of those devices
14. Searches for an SMB Shared Folder
15. Copies itself to any shared folders
16. Creates a second file in the Startup dir that serves as a third reminder and tells them how to delete the virus

# SHCoatl.bat
The medium difficulty, Simulation Hitchhiker Coatl is better at its job and also makes it harder to remove by removing browser access and not explicitly telling the user how to remove itself
1. The script tries to find the shared folder name on the network using the `net share` command and saves it for later use.
2. It checks if the SMB shared folder exists. If not, the script exits.
3. Coatl copies itself (`shcoatl.bat`) to every computer in the network's shared folder.
4. The script executes `shcoatl.bat` on every computer in the network using `PsExec`.
5. It prints an ASCII Art representation of Coatl, along with a warning message indicating that the computer is infected.
6. The script checks if it's running with administrative privileges. If not, it asks for permissions.
7. Coatl adds an outbound rule to allow FTP traffic through the Windows Firewall.
8. It adds a deny inbound HTTPS traffic on port 80.
9. The script moves itself to the Downloads folder for cleanup.
10. Coatl creates a batch file named `SystemSettings.bat` in the Startup folder to remind the user about the compromisation.
11. It generates an FTP script file named "FTP.txt" to easily file transfer via FTP.
12. The script creates a LAN IP getter batch script to scan the local network for IP addresses.
13. Coatl copies itself to any accessible SMB shared folders on the local network.
14. The script prints a message indicating that it has finished transferring itself to other devices on the network.
15. Coatl creates a batch file named `StartupConfig.bat` in the Startup folder, providing additional information about the compromise.

# RHCoatl.bat
An actual test for your network, Real Hitchhiker Coatl is much closer to an actual virus without causing any damage, might even stump newer cybersec experts.
Sure, let's break down these steps into smaller, more detailed actions:

1. **Finding SMB Shared Folder Name**:
   - Uses the `net share` command to retrieve information about shared folders on the network.
   - Parses the output to extract the name of the SMB shared folder.
   - Stores the shared folder name for later use.

2. **Checking SMB Shared Folder Existence**:
   - Verifies if the SMB shared folder exists on the network.
   - If the folder does not exist, the script terminates further execution.

3. **Copying `hcoatl.bat` to Network Computers**:
   - Copies the script file `hcoatl.bat` to the shared folder on every computer in the network.
   - Ensures that the script is accessible on each machine for execution.

4. **Executing `hcoatl.bat` on Network Computers**:
   - Utilizes PsExec, a command-line utility, to run `hcoatl.bat` remotely on each computer in the network.
   - Initiates the execution of the script across all network machines.

5. **Checking Administrative Privileges**:
   - Determines whether the script is running with administrative privileges.
   - If not, attempts to elevate its privileges to ensure successful execution of administrative commands.

6. **Adding Outbound FTP Rule**:
   - Uses the `netsh` command to add a new outbound rule to the Windows Firewall.
   - Configures the rule to allow FTP traffic (TCP protocol) on port 21 for outbound connections.

7. **Adding Outbound HTTPS Denial Rule**:
   - Implements another `netsh` command to add an outbound rule to the Windows Firewall.
   - Specifies the rule to deny inbound HTTPS traffic (TCP protocol) on port 80, restricting web traffic.

8. **Moving Script to Downloads Folder**:
   - Retrieves the path of the user's Downloads folder from the Windows registry.
   - Moves the script file (`shcoatl.bat`) to the Downloads folder for persistence and execution on system startup.

9. **Creating `StartupConfig.bat` in Startup Folder**:
   - Generates a batch script named `StartupConfig.bat` in the user's Startup folder.
   - Configures this script to execute on system startup to enforce network security settings.

10. **Generating FTP Script File (`FTP.txt`)**:
    - Creates a text file named `FTP.txt` to facilitate FTP file transfers.
    - Populates the file with commands for anonymous FTP login and file upload (`put` command).

11. **Creating LAN IP Getter Batch Script**:
    - Constructs a batch script to obtain the IPv4 addresses of devices on the local network.
    - Utilizes the `ipconfig` command and parsing techniques to extract IP addresses.
    - Implements a loop to scan IP addresses within a specified range and record the results in a file (`ipaddresses.txt`).
