# CrownStone

The [Crownstone](http://dobots.nl/products/crownstone) is an nRF51822-based product from [DoBots](http://dobots.nl). DoBots is one of dozen daughter companies of the research institute [Almende](http://almende.com). DoBots performs commercial activities in two areas:

* [Smart Buildings](http://dobots.nl/products/crownstone/)
* [Smart Robots](http://dobots.nl/products/autopilot/)

There is a lot of nonsense written about "Smart Buildings". At DoBots we create these actual products, no vaporware! that give buildings eyes and ears!

The Crownstone is a Bluetooth Low-Energy switching block that can be embedded everywhere in a building. Not only can people use their smartphones to control every wire in the building, but also the building knows where the people are. This means:

* An audiotour through a museum adjusted to your preferences
* Directing people to the right track on a railway station
* An alarm service in a daycare center or hospital
* An office that shuts down all devices (except for fridges, etc.) at night

The combination of observation and control allows for services that satisfy both facility managers as well as end-users.

The basic software layer that resides on the Crownstone is open-source and its unofficial working name is [BlueNet](https://github.com/mrquincle/bluenet). You can use the application in this github repository to connect to it. More sophisticated software for accurate positioning, and dedicated services for end-users are, naturally, proprietary. However, if you have a specific end-user in mind, feel free to contact us about the possibilities to license this software. In that case you don't need to worry about configuring the system, position other nodes, or users, device profiling, etc.

## Cordova

The code that is cross-platform, is developed through Cordova.

### Android

Commands can be found on the [project site](https://cordova.apache.org/docs/en/3.4.0/guide_platforms_ubuntu_index.md.html).

To build the project:

    cordova build android

To run the application in the emulator:

    cordova run android

The application is not necessarily automatically started, so after the emulator starts, navigate to applications, and click on the icon with the text "Crownstone".

To run the application:

    cordova run android --device

If there are no devices found, make sure you have connected the device to your laptop and check if it is recognized by the operating system.

    $> lsusb
    Bus 003 Device 010: ID 18d1:d002 Google Inc. 

Turn on debugging on the phone, on an Android this is five times clicking on settings, or something silly like that.

    adb devices

This list all devices, the following happens if your permissions are incorrect:

    $> adb devices
    List of devices attached 
    emulator-5554	device
    ????????????	no permissions

Make sure in that case that you have a udev rule with the group "plugdev":

    $> cat /etc/udev/rules.d/50-android.rules 
    SUBSYSTEM=="usb", ATTR{idVendor}=="18d1", MODE="0666", GROUP="plugdev"
    sudo udevadm control --reload-rules
    sudo service udev restart

And make sure adb is in the right group.

    sudo chown root.plugdev $(which adb)

Now, you will see your devices on `adb devices` and you can try again the `cordova run android --device` command. This is worth it, because an actual phone runs much faster than the emulator.

This fails again on my system, with some weird error:

```
Generating config.xml from defaults for platform "android"
Running app on platform "android" via command "$HOME/myworkspace/virtuele-memo/ios/cordova-style/com.almende.CrownStone/platforms/android/cordova/run" --device
Error: An error occurred while running the android project.
$HOME/myworkspace/virtuele-memo/ios/cordova-style/com.almende.CrownStone/platforms/android/cordova/node_modules/q/q.js:126
                    throw e;
                          ^
ERROR: Failed to launch application on device: ERROR: Failed to install apk to device: Error: Unknown encoding
```

However, I can't be bothered much, because it is easy to install it manually:

    adb install platforms/android/ant-build/Crownstone-debug.apk

Get the name of the activity to launch:

    $> aapt dump badging platforms/android/ant-build/Crownstone-debug.apk | grep activity
    launchable-activity: name='nl.dobots.CrownStone.Crownstone'  label='Crownstone' icon=''

And run it:

    adb shell am start -n nl.dobots.CrownStone/.Crownstone

And to get rid of it:

    $> adb uninstall com.almende.CrownStone
    Success

### BluetoothLE

To support Bluetooth LE, we used a plugin:

    cordova plugin add https://github.com/randdusing/BluetoothLE.git

To know on which type of device we or working, we use another plugin:

    cordova plugin add org.apache.cordova.device

Notifications are added as plugin as well:

    cordova plugin add https://git-wip-us.apache.org/repos/asf/cordova-plugin-dialogs.git

This should automatically adjust your platform-specific configuration files as specified on [cordova.apache.org](https://cordova.apache.org/docs/en/3.0.0/cordova_notification_notification.md.html).

## Copyrights

The copyrights (2014) for this code belongs to [DoBots](http://dobots.nl) and are provided under an noncontagious open-source license:

* Author: Anne van Rossum
* Date: 22 Jul. 2014
* License: LGPL v3
* Distributed Organisms B.V. (DoBots), http://www.dobots.nl
* Rotterdam, The Netherlands

