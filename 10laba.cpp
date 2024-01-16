#include <iostream>
#include <vector>

using namespace std;
int main() {
	int n;
	cin >> n;
	vector <int> vec(n);
	for (int i = 0; i < n; i++) {
		cin >> vec[i];
	}
	vec.push_back(1); // Добавляем элемент 1 в конец вектора
	vec.push_back(3); // Добавляем элемент 2 в конец вектора

	vec.erase(vec.begin()); // Удаляем первый элемент вектора

	vec.insert(vec.begin(), 3); // Вставляем элемент 3 в начало вектора

	for (int i = 0; i < n; i++) {
		cout << vec[i];
	}
	vec.clear(); // Очищаем вектор
}
	