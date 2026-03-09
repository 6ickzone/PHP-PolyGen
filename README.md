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

### Technical Flow

1. **Advanced Compression Stage**
   - **Method**: Utilizes `gzdeflate()` or `gzcompress()` with maximum compression (Level 9).
   - **Purpose**: Shrinks the raw source code into binary data, acting as the first layer to strip away recognizable PHP keywords and structures.

2. **Multi-Layer Encryption Chain**
   - **Dynamic XOR Cipher**: Employs a unique `random_bytes` key for every build. Data is processed through a character-wise XOR operation ($Data_i \oplus Key_{i \pmod n}$).
   - **String Transformation**: Applies a string reversal technique to further scramble the binary sequence.
   - **Hex/Base64 Encoding**: Converts the final binary output into a safe-string format using `bin2hex` and `base64_encode` for transportability.

3. **Polymorphic Stub Generation**
   - **Systematic Obfuscation**: Class names, methods, and variables are randomized using MD5-based algorithms, ensuring every build is unique.
   - **ReflectionMethod Execution**: Instead of direct execution, the stub utilizes PHP's `ReflectionMethod` to invoke the decrypted code directly in RAM (memory), bypassing file-based security scanners.
   - **Validation Header**: Injects system metadata including a unique `uniqid` and the `poly.6ickzone.site` authority tag for traceability.


## About the Author

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
