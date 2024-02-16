
#include <iostream>
#include <fstream>
#include <string>
#include <stdio.h>
#include <ctime>

namespace pp {
    void print_of_text() {
        int number_of_lines = 1;
        std::string line;
        std::ifstream file("assets/input.txt");
        while (std::getline(file, line))
            ++number_of_lines;

        std::ofstream fout("assets/input.txt", std::ios::app);

        time_t t1 = time(NULL);
        tm t = *localtime(&t1);

        fout<< number_of_lines << '-' << t.tm_year - 100 << "-" << t.tm_mon + 1 << '-' << t.tm_mday << '-' << t.tm_hour << '-' << t.tm_min << '-'
            << t.tm_sec << std::endl;
    }
}