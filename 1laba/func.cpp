#include "func.h"
#include <fstream>
#include <ctime>
#include <iomanip>
#include <iostream>

namespace FileIO {
    void appendTimeToFile(const std::string& filename) {
        std::ofstream file(filename, std::ios::app);
        if (file.is_open()) {
            std::time_t now = std::time(nullptr);
            std::tm* tm = std::localtime(&now);

            file << std::put_time(tm, "%Y-%m-%d %H:%M:%S") << std::endl;

            file.close();
        }
        else {
            std::cout << "Error opening file." << std::endl;
        }
    }
}