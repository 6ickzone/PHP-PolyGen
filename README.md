# PHP PolyGen V2.3 - PHP Polymorphic Generator

![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-777bb4?style=for-the-badge&logo=php)
![Category](https://img.shields.io/badge/Focus-Educational%20Research-blue?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

**PHP PolyGen** is a sophisticated PHP code protection engine utilizing **Polymorphic Encryption**. Unlike standard static obfuscators, this engine ensures that every generated file possesses a unique structure, variable naming convention, and decryption signature. 

This approach is specifically designed to bypass static signature-based scanners and Web Application Firewalls (WAF) by shifting the code's "DNA" on every generation.

---

## Features

* **Dynamic XOR Chain**: Data is scrambled using dynamic keys that are split into multiple segments within the stub loader.
* **Batch ZIP Processing**: Supports automated encryption for entire website project folders (`.zip`) with built-in stability limits.
* **Stealth RAM Execution**: Utilizes `ReflectionMethod` to execute code directly in memory, bypassing file-based security scanners.
* **Branded Unique ID**: Every output includes a unique traceability ID and validation from [poly.6ickzone.site](https://poly.6ickzone.site).

## Technical Flow

The encryption process follows a multi-stage pipeline to ensure data integrity and logic security:

1.  **Compression**: The original source code is compressed using `GZDeflate` for maximum file size efficiency.
2.  **Encryption Chain**: Data passes through a dynamic XOR chain, Hex-encoding, and string reversal to destroy recognizable text patterns.
3.  **Polymorphic Stubbing**: A randomized loader (stub) is generated with systematically obfuscated class and function names.

## 👨‍💻 About the Author

Developed by **6ickzone** 

* **Expertise**: Active in web security research and exploitation since 2017.
* **Focus**: Cybersecurity, Vulnerability Research, and Advanced Web Protection.

---

## ⚠️ Disclaimer

This project is created strictly for **Educational Research** purposes. Any misuse of this tool for illegal activities is beyond the responsibility of the developer. Use it wisely to secure your own intellectual property.

## License

Distributed under the MIT License. See `LICENSE` for more information.

---
### Official Links
[6ickzone.site](https://6ickzone.site) | [poly.6ickzone.site](https://poly.6ickzone.site) | [0x6ick.my.id](https://0x6ick.my.id)
