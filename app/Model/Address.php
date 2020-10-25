<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public static function findId($type, $id)
    {
        if($type=='tinh'){
            foreach (static::city() as $key => $value) {
                if($value->id==$id) return $value;
            }
        }
        if($type=='huyen'){
            foreach (static::district() as $key => $value) {
                if($value->id==$id) return $value;
            }
        }
        if($type=='xa'){
            foreach (static::town() as $key => $value) {
                if($value->id==$id) return $value;
            }
        }
        return [];
    }
    public static function city()
    {
        return [
            (object)['id' => 1, 'name_city' => 'Hà Nội'],
            (object)['id' => 2, 'name_city' => 'TP.Hồ Chí Minh'],
            (object)['id' => 3, 'name_city' => 'Hà Nam'],
            (object)['id' => 4, 'name_city' => 'Nam Định']
        ];
    }
    public static function district()
    {
        return [
            (object)['id' => 1, 'name_district' => 'Quận Ba Đình', 'city_id' => 1 ],
            (object)['id' => 2, 'name_district' => 'Quận Bắc Từ Liêm', 'city_id' => 1],
            (object)['id' => 3, 'name_district' => 'Quận Cầu Giấy', 'city_id' => 1],
            (object)['id' => 4, 'name_district' => 'Quận Đống Đa', 'city_id' => 1],
            (object)['id' => 5, 'name_district' => 'Quận Hà Đông', 'city_id' => 1],
            (object)['id' => 6, 'name_district' => 'Quận Hai Bà Trưng', 'city_id' => 1],
            (object)['id' => 7, 'name_district' => 'Quận Hoàn Kiếm', 'city_id' => 1],
            (object)['id' => 8, 'name_district' => 'Quận Hoàng Mai', 'city_id' => 1],
            (object)['id' => 9, 'name_district' => 'Quận Long Biên', 'city_id' => 1],
            (object)['id' => 10, 'name_district' => 'Quận Nam Từ Liêm', 'city_id' => 1],
            (object)['id' => 11, 'name_district' => 'Quận Tây Hồ', 'city_id' => 1],
            (object)['id' => 12, 'name_district' => 'Quận Thanh Xuân', 'city_id' => 1],
            (object)['id' => 13, 'name_district' => 'Thị xã Sơn Tây', 'city_id' => 1],
            (object)['id' => 14, 'name_district' => 'Huyện Ba Vì', 'city_id' => 1],
            (object)['id' => 15, 'name_district' => 'Huyện Chương Mỹ', 'city_id' => 1],
            (object)['id' => 16, 'name_district' => 'Huyện Đan Phượng', 'city_id' => 1],
            (object)['id' => 17, 'name_district' => 'Huyện Đông Anh', 'city_id' => 1],
            (object)['id' => 18, 'name_district' => 'Huyện Gia Lâm', 'city_id' => 1],
            (object)['id' => 19, 'name_district' => 'Huyện Hoài Đức', 'city_id' => 1],
            (object)['id' => 20, 'name_district' => 'Huyện Mê Linh', 'city_id' => 1],
            (object)['id' => 21, 'name_district' => 'Huyện Mỹ Đức', 'city_id' => 1],
            (object)['id' => 22, 'name_district' => 'Huyện Phú Xuyên', 'city_id' => 1],
            (object)['id' => 23, 'name_district' => 'Huyện Phúc Thọ', 'city_id' => 1],
            (object)['id' => 24, 'name_district' => 'Huyện Quốc Oai', 'city_id' => 1],
            (object)['id' => 25, 'name_district' => 'Huyện Sóc Sơn', 'city_id' => 1],
            (object)['id' => 26, 'name_district' => 'Huyện Thạch Thất', 'city_id' => 1],
            (object)['id' => 27, 'name_district' => 'Huyện Thanh Oai', 'city_id' => 1],
            (object)['id' => 28, 'name_district' => 'Huyện Thanh Trì', 'city_id' => 1],
            (object)['id' => 29, 'name_district' => 'Huyện Thường Tín', 'city_id' => 1],
            (object)['id' => 30, 'name_district' => 'Huyện Ứng Hòa', 'city_id' => 1],

            (object)['id' => 31, 'name_district' => 'Huyện Bình Chánh', 'city_id' => 2],
            (object)['id' => 32, 'name_district' => 'Huyện Cần Giờ', 'city_id' => 2],
            (object)['id' => 33, 'name_district' => 'Huyện Củ Chi', 'city_id' => 2],
            (object)['id' => 34, 'name_district' => 'Huyện Hóc Môn', 'city_id' => 2],
            (object)['id' => 35, 'name_district' => 'Huyện Nhà Bè', 'city_id' => 2],
            (object)['id' => 36, 'name_district' => 'Quận 1', 'city_id' => 2],
            (object)['id' => 37, 'name_district' => 'Quận 10', 'city_id' => 2],
            (object)['id' => 38, 'name_district' => 'Quận 11', 'city_id' => 2],
            (object)['id' => 39, 'name_district' => 'Quận 12', 'city_id' => 2],
            (object)['id' => 40, 'name_district' => 'Quận 2', 'city_id' => 2],
            (object)['id' => 41, 'name_district' => 'Quận 3', 'city_id' => 2],
            (object)['id' => 42, 'name_district' => 'Quận 4', 'city_id' => 2],
            (object)['id' => 43, 'name_district' => 'Quận 5', 'city_id' => 2],
            (object)['id' => 44, 'name_district' => 'Quận 6', 'city_id' => 2],
            (object)['id' => 45, 'name_district' => 'Quận 7', 'city_id' => 2],
            (object)['id' => 46, 'name_district' => 'Quận 8', 'city_id' => 2],
            (object)['id' => 47, 'name_district' => 'Quận 9', 'city_id' => 2],
            (object)['id' => 48, 'name_district' => 'Quận Bình Tân', 'city_id' => 2],
            (object)['id' => 49, 'name_district' => 'Quận Bình Thạnh', 'city_id' => 2],
            (object)['id' => 50, 'name_district' => 'Quận Gò Vấp', 'city_id' => 2],
            (object)['id' => 51, 'name_district' => 'Quận Phú Nhuận', 'city_id' => 2],
            (object)['id' => 52, 'name_district' => 'Quận Tân Bình', 'city_id' => 2],
            (object)['id' => 53, 'name_district' => 'Quận Tân Phú', 'city_id' => 2],
            (object)['id' => 54, 'name_district' => 'Quận Thủ Đức', 'city_id' => 2],

            (object)['id' => 55, 'name_district' => 'Huyện Bình Lục', 'city_id' => 3],
            (object)['id' => 56, 'name_district' => 'Huyện Duy Tiên', 'city_id' => 3],
            (object)['id' => 57, 'name_district' => 'Huyện Kim Bảng', 'city_id' => 3],
            (object)['id' => 58, 'name_district' => 'Huyện Lý Nhân', 'city_id' => 3],
            (object)['id' => 59, 'name_district' => 'Huyện Thanh Liêm', 'city_id' => 3],
            (object)['id' => 60, 'name_district' => 'Thành phố Phủ Lý', 'city_id' => 3],

            (object)['id' => 61, 'name_district' => 'Huyện Nghĩa Hưng', 'city_id' => 4],
            (object)['id' => 62, 'name_district' => 'Huyện Hải Hậu', 'city_id' => 4],
            (object)['id' => 63, 'name_district' => 'Huyện Mỹ Lộc', 'city_id' => 4],
            (object)['id' => 64, 'name_district' => 'Huyện Nam Trực', 'city_id' => 4],
            (object)['id' => 65, 'name_district' => 'Huyện Giao Thủy', 'city_id' => 4],
            (object)['id' => 66, 'name_district' => 'Huyện Trực Ninh', 'city_id' => 4],
            (object)['id' => 67, 'name_district' => 'Huyện Vụ Bản', 'city_id' => 4],
            (object)['id' => 68, 'name_district' => 'Huyện Xuân Trường', 'city_id' => 4],
            (object)['id' => 69, 'name_district' => 'Huyện Ý Yên', 'city_id' => 4],
            (object)['id' => 70, 'name_district' => 'Thành phố Nam Định', 'city_id' => 4]

        ];
    }

    public static function town()
    {
        return [
            (object)['id' => 1, 'name_town' => 'Phường Phúc Xá', 'district_id' => 1],
            (object)['id' => 2, 'name_town' => 'Phường Trúc Bạch', 'district_id' => 1],
            (object)['id' => 3, 'name_town' => 'Phường Vĩnh Phúc', 'district_id' => 1],
            (object)['id' => 4, 'name_town' => 'Phường Cống Vị', 'district_id' => 1],
            (object)['id' => 5, 'name_town' => 'Phường Liễu Giai', 'district_id' => 1],
            (object)['id' => 6, 'name_town' => 'Phường Nguyễn Trung Trực', 'district_id' => 1],
            (object)['id' => 7, 'name_town' => 'Phường Quán Thánh', 'district_id' => 1],
            (object)['id' => 8, 'name_town' => 'Phường Ngọc Hà', 'district_id' => 1],
            (object)['id' => 9, 'name_town' => 'Phường Điện Biên', 'district_id' => 1],
            (object)['id' => 10, 'name_town' => 'Phường Đội Cấn', 'district_id' => 1],
            (object)['id' => 11, 'name_town' => 'Phường Ngọc Khánh', 'district_id' => 1],
            (object)['id' => 12, 'name_town' => 'Phường Kim Mã', 'district_id' => 1],
            (object)['id' => 13, 'name_town' => 'Phường Giảng Võ', 'district_id' => 1],
            (object)['id' => 14, 'name_town' => 'Phường Thành Công', 'district_id' => 1],
            (object)['id' => 15, 'name_town' => 'Phường Thượng Cát', 'district_id' => 2],
            (object)['id' => 16, 'name_town' => 'Phường Liên Mạc', 'district_id' => 2],
            (object)['id' => 17, 'name_town' => 'Phường Đông Ngạc', 'district_id' => 2],
            (object)['id' => 18, 'name_town' => 'Phường Đức Thắng', 'district_id' => 2],
            (object)['id' => 19, 'name_town' => 'Phường Thụy Phương', 'district_id' => 2],
            (object)['id' => 20, 'name_town' => 'Phường Tây Tựu', 'district_id' => 2],
            (object)['id' => 21, 'name_town' => 'Phường Xuân Đỉnh', 'district_id' => 2],
            (object)['id' => 22, 'name_town' => 'Phường Xuân Tảo', 'district_id' => 2],
            (object)['id' => 23, 'name_town' => 'Phường Minh Khai', 'district_id' => 2],
            (object)['id' => 24, 'name_town' => 'Phường Cổ Nhuế 1', 'district_id' => 2],
            (object)['id' => 25, 'name_town' => 'Phường Cổ Nhuế 2', 'district_id' => 2],
            (object)['id' => 26, 'name_town' => 'Phường Phú Diễn', 'district_id' => 2],
            (object)['id' => 27, 'name_town' => 'Phường Phúc Diễn', 'district_id' => 2],
            (object)['id' => 28, 'name_town' => 'Thị trấn Tân Túc', 'district_id' => 31],
            (object)['id' => 29, 'name_town' => 'Xã Phạm Văn Hai', 'district_id' => 31],
            (object)['id' => 30, 'name_town' => 'Xã Vĩnh Lộc A', 'district_id' => 31],
            (object)['id' => 31, 'name_town' => 'Xã Vĩnh Lộc B', 'district_id' => 31],
            (object)['id' => 32, 'name_town' => 'Xã Bình Lợi', 'district_id' => 31],
            (object)['id' => 33, 'name_town' => 'Xã Lê Minh Xuân', 'district_id' => 31],
            (object)['id' => 34, 'name_town' => 'Xã Tân Nhựt', 'district_id' => 31],
            (object)['id' => 35, 'name_town' => 'Xã Tân Kiên', 'district_id' => 31],
            (object)['id' => 36, 'name_town' => 'Xã Bình Hưng', 'district_id' => 31],
            (object)['id' => 37, 'name_town' => 'Xã Phong Phú', 'district_id' => 31],
            (object)['id' => 38, 'name_town' => 'Xã An Phú Tây', 'district_id' => 31],
            (object)['id' => 39, 'name_town' => 'Xã Hưng Long', 'district_id' => 31],
            (object)['id' => 40, 'name_town' => 'Xã Đa Phước', 'district_id' => 31],
            (object)['id' => 41, 'name_town' => 'Xã Tân Quý Tây', 'district_id' => 31],
            (object)['id' => 42, 'name_town' => 'Xã Bình Chánh', 'district_id' => 31],
            (object)['id' => 43, 'name_town' => 'Xã Quy Đức', 'district_id' => 31],
            (object)['id' => 44, 'name_town' => 'Thị trấn Bình Mỹ', 'district_id' =>55],
            (object)['id' => 45, 'name_town' => 'Xã Bình Nghĩa', 'district_id' =>55],
            (object)['id' => 46, 'name_town' => 'Xã Tràng An', 'district_id' =>55],
            (object)['id' => 47, 'name_town' => 'Xã Đồng Du', 'district_id' =>55],
            (object)['id' => 48, 'name_town' => 'Xã Ngọc Lũ', 'district_id' =>55],
            (object)['id' => 49, 'name_town' => 'Xã Hưng Công', 'district_id' =>55],
            (object)['id' => 50, 'name_town' => 'Xã Đồn Xá', 'district_id' =>55],
            (object)['id' => 51, 'name_town' => 'Xã An Ninh', 'district_id' =>55],
            (object)['id' => 52, 'name_town' => 'Xã Bồ Đề', 'district_id' =>55],
            (object)['id' => 53, 'name_town' => 'Xã Bối Cầu', 'district_id' =>55],
            (object)['id' => 54, 'name_town' => 'Xã An Mỹ', 'district_id' =>55],
            (object)['id' => 55, 'name_town' => 'Xã An Nội', 'district_id' =>55],
            (object)['id' => 56, 'name_town' => 'Xã Vũ Bản', 'district_id' =>55],
            (object)['id' => 57, 'name_town' => 'Xã Trung Lương', 'district_id' =>55],
            (object)['id' => 58, 'name_town' => 'Xã Mỹ Thọ', 'district_id' =>55],
            (object)['id' => 59, 'name_town' => 'Xã An Đổ', 'district_id' =>55],
            (object)['id' => 60, 'name_town' => 'Xã La Sơn', 'district_id' =>55],
            (object)['id' => 61, 'name_town' => 'Xã Tiêu Động', 'district_id' =>55],
            (object)['id' => 62, 'name_town' => 'Xã An Lão', 'district_id' =>55],
            (object)['id' => 63, 'name_town' => 'Thị trấn Liễu Đề', 'district_id' =>61],
            (object)['id' => 64, 'name_town' => 'Thị trấn Rạng Đông', 'district_id' =>61],
            (object)['id' => 65, 'name_town' => 'Xã Nghĩa Đồng', 'district_id' =>61],
            (object)['id' => 66, 'name_town' => 'Xã Nghĩa Thịnh', 'district_id' =>61],
            (object)['id' => 67, 'name_town' => 'Xã Nghĩa Minh', 'district_id' =>61],
            (object)['id' => 68, 'name_town' => 'Xã Nghĩa Thái', 'district_id' =>61],
            (object)['id' => 69, 'name_town' => 'Xã Hoàng Nam', 'district_id' =>61],
            (object)['id' => 70, 'name_town' => 'Xã Nghĩa Châu', 'district_id' =>61],
            (object)['id' => 71, 'name_town' => 'Xã Nghĩa Trung', 'district_id' =>61],
            (object)['id' => 72, 'name_town' => 'Xã Nghĩa Sơn', 'district_id' =>61],
            (object)['id' => 73, 'name_town' => 'Xã Nghĩa Lạc', 'district_id' =>61],
            (object)['id' => 74, 'name_town' => 'Xã Nghĩa Hồng', 'district_id' =>61],
            (object)['id' => 75, 'name_town' => 'Xã Nghĩa Phong', 'district_id' =>61],
            (object)['id' => 76, 'name_town' => 'Xã Nghĩa Phú', 'district_id' =>61],
            (object)['id' => 77, 'name_town' => 'Xã Nghĩa Bình', 'district_id' =>61],
            (object)['id' => 78, 'name_town' => 'Thị trấn Quỹ Nhất', 'district_id' =>61],
            (object)['id' => 79, 'name_town' => 'Xã Nghĩa Tân', 'district_id' =>61],
            (object)['id' => 80, 'name_town' => 'Xã Nghĩa Hùng', 'district_id' =>61],
            (object)['id' => 81, 'name_town' => 'Xã Nghĩa Lâm', 'district_id' =>61],
            (object)['id' => 82, 'name_town' => 'Xã Nghĩa Thành', 'district_id' =>61],
            (object)['id' => 83, 'name_town' => 'Xã Nghĩa Thắng', 'district_id' =>61],
            (object)['id' => 84, 'name_town' => 'Xã Nghĩa Lợi', 'district_id' =>61],
            (object)['id' => 85, 'name_town' => 'Xã Nghĩa Hải', 'district_id' =>61],
            (object)['id' => 86, 'name_town' => 'Xã Nghĩa Phúc', 'district_id' =>61],
            (object)['id' => 87, 'name_town' => 'Xã Nam Điền', 'district_id' =>61],


        ];
    }
}
