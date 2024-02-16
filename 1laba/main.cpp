
#include <iostream>
#include <fstream>
#include "func.h"

int main()
{
    std::fstream in("assets/input.txt");
    if (!in.is_open()) {
        std::cerr << "File open error" << std::endl;
        return -1;
    }
    else {
        pp::print_of_text();
    }
}