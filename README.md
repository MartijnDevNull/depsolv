# depsolv
Webtool for resolving dependency errors.

### Example
```
± % ./compile                                                             !7968
Keylogger.cpp:14:28: fatal error: wayland-client.h: No such file or directory
 #include <wayland-client.h>
                            ^
compilation terminated.
```

Which package has `wayland-client.h`?

![alt tag](https://i.imgur.com/0KIsXMj.png)

`libwayland-dev` apparantly!

**Live:** https://depsolv.plebian.nl
