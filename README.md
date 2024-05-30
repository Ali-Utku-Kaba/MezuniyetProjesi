index.php -> Bu sayfa üzerinden kullanıcılar karşılanır ve eğer kayıt olmaları gerekiyorsa gerekli yönlendirmeler yapılır.

config.php -> Bu sayfa üzerinden php dosyalarının veritabanı bağlantısı gerçekleştirilir.

login.php -> Bu sayfa üzerinden giriş işlemi gerçekleştirilir. Kullanıcı adı ve şifre kullanılır. Kullanıcı giriş yapmak istediği rolü açılabilir menüden seçebilir.

register_student.php -> Bu sayfa üzerinden öğrencinin kayıt olması için gerekli bilgilerin girilmesi beklenir.

register_student_process.php -> Bu sayfa üzerinden öğrencinin kayıt olması için gerekli bilgilerin veritabanına aktarılması gerçekleştirilir.

register_dorm_owner.php -> Bu sayfa üzerinden yurt sahiplerinin kayıt olması için gerekli bilgilerin girilmesi beklenir.

register_dorm_owner_process.php -> Bu sayfa üzerinden yurt sahiplerinin kayıt olması için gerekli bilgilerin veritabanına aktarılması gerçekleştirilir.

dashboard.php -> Bu sayfa üzerinden kullanıcnın rolüne göre yönetim paneli yönlendirmesi yapılır. Bu sayfa üzerinden dil tercihi yapılabilir ve yapılan dil tercihi cookie olarak tutulup diğer sayfalar için de geçerli hale getirilir.

student_dashboard.php -> Kullanıcı eğer öğrenci rolündeyse bu sayfaya yönlendirilir, bu sayfa üzerinden Okul Duvarına, İletişim Bilgileri Talep İsteklerine, Yurt Bulma ve Oda Arkadaşı Bulma ekranına erişebilir.

admin_dashboard.php -> Kullanıcı eğer admin rolündeyse bu sayfaya yönlendirilir, bu sayfa üzerinden Okul Duvarına, Onay Bekleyen Öğrencilere ve Onay Bekleyen Yurt Sahiplerine erişebilir.


dorm_owner_dashboard.php -> Kullanıcı eğer yurt sahibi rolündeyse bu sayfaya yönlendirilir, bu sayfa üzerinden Yurt Odası Ekleme, Yurt Odası Rezervasyon İsteklerine ve Öğrenciler tarafından gönderilen istek, öneri, şikayet ekranına erişebilir.

wall.php -> Öğrencilerin anonim veya ismi açık bir şekilde yaptıkarı paylaşımların gösterildiği sayfadır. Bu sayfa üzerinden anonim veya isim açık şekilde yorum da yapılabilir. Aynı zamanda Gönderi oluşturma butonu bu ekranda bulunmaktadır.

add_post.php -> Bu ekran üzerinden öğrenciler anonim veya ismi açık şekilde paylaşım yapabilirler.

add_comment.php -> Bu sayfa üzerinden duvardaki gönderiya yapılan yorum veritabanına aktarılır.


add_room.php -> Bu ekran üzerinden yurt sahipleri yurt odalarını eklemek için gerekli bilgi girişi yapmaları beklenir.

add_room_process.php -> Bu sayfa üzerinden bilgileri girilen yurt odaları veritabanına aktarılır.

approve_contact_request.php -> Bu sayfa üzerinden öğrenci, diğer kullanıcılar tarafından gelen iletişim bilgi taleplerini görüntüleyebilir. Bu talepleri onaylayabilir veya reddedebilir. Talebi onaylaması durumunda eposta ve telefon numarası bilgisi, talep eden kişinin ekranına yansıtılır.

delete_comment.php -> Bu sayfa üzerinden admin tarafından duvara yapılan yorum kaldırıldığında veritabanından silinir.

delete_post.php -> Bu sayfa üzerinden admin tarafından duvardan silinen gönderi veritabanından kaldırılır.

delete_reservation.php -> Yurt sahipleri yurt odası öğrenci tarafından talep edilen rezervasyon isteğini gördükten sonra bu sayfa sayesinde veritabanından silinir.

delete_room.php -> Bu sayfa üzerinden yurt sahipleri tükenen veya yanlış bilgisi girilen yurt odalarını veritabanından silinir.

dorm_room_list.php -> Yurt sahiplerinin kendi yurt odalarını listelediği ekran. Bu ekran üzerinden yurt odalarını silebilir veya düzenleyebilir.

edit_room.php -> Yurt sahipleri kendi yurt odalarının bilgilerini bu sayfa üzerinden güncelleyebilir.

find_dorm_room.php -> Kullanıcının seçtiği yurt için odaların listelendiği ekran.

find_roommate.php -> Öğrencinin oda arkadaşı için eşleşme tercihlerini yaptığı sayfa.

form_page.php -> Öğrencilerin yurt sahiplerine istek, öneri ve şikayet başlıkları altında mesaj gönderebildikleri sayfa.

header.php -> Kullanıcının rolüne göre dashboard yönlendirmesi yapmasına sağlayan sayfa.

lang_eng.pgp -> İngilizce dil seçimi durumunda kelimelerin gözükeceği İngilizce karşılıklar.

lang_tur.pgp -> Türkçe dil seçimi durumunda kelimelerin gözükeceği Türkçe karşılıklar.

language_dropdown.php -> Dil seçeneği için gerekli olan kodun bulunduğu sayfa.

login_process.php -> Giriş işleminin veritabanı kontrolünü sağlamasına yarayan kodun bulunduğu sayfa.

pending_dorm_owners.php -> Kayıt yapmış ancak yönetici onayını bekleyen yurt sahiplerinin listelendiği ekran.

pending_students.php -> Kayıt yapmış ancak yönetici onayını bekleyen öğrencilerin listelendiği ekran.

process_request.php -> Öğrenciye başka öğrenci tarafından gelen İletişim Bilgileri Paylaşma ekranının veritabanda işlem yapacağı kodun bulunduğu sayfa.

rate_dorm.php -> Öğrenciler tarafından yurtların puanlandığı kodun bulunduğu sayfa.

roommate_match.php -> Öğrencilerin kendi aralarında uyumluluklarını ve iletişim bilgi isteği gönderebilecekleri ekran.

send_message.php -> Kullanıcıların istek, öneri ve şikayet başlıkları altında gönderdikleri mesajların veritabanına aktarılmasını sağlayan kodun bulunduğu sayfa.

submit_reservation.php -> Kullanıcıların yurt odaları için rezervasyon yaptıkları ekranın veritabanına aktarılmasını sağlayan kodun bulunduğu sayfa.

submit_survey.php -> Öğrencinin oda arkadaşı tercihi için yanıtladığı soruların veritabanına aktarılması için kullanılan kodun bulunduğu sayfa.

view_message.php -> Öğrenciler tarafından gönderilmiş mesajların yurt yöneticileri tarafından görüntülendiği ekran.

view_reservation_request.php- -> Yurt sahipleri tarafından rezervasyon isteklerinin görüntülendiği ekran.

view_rooms.php -> Öğrenciler tarafından yurt odalarının listelenip görüntülenmesini sağlayan ekran.
