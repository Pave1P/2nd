#include <iostream>
#include <cmath>
using namespace std;
class Rectangle {
private:
    float width;
    float height;

public:
    Rectangle(float w, float h) : width(w), height(h) {}

    float getArea() {
        return width * height;
    }

    float getPerimeter() {
        return 2 * (width + height);
    }

    float getDiagonal() {
        return sqrt(pow(width, 2) + pow(height, 2));
    }
};
int main() {
    setlocale(LC_ALL, "Rus");

    Rectangle rect(3, 3);

    std::cout << "Площадь: " << rect.getArea() << std::endl;
    std::cout << "Периметр: " << rect.getPerimeter() << std::endl;
    std::cout << "Длина диагонали: " << rect.getDiagonal() << std::endl;

    return 0;
}
