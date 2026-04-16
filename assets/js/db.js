const initialState = {
  "buses": [
    {
      "id": 10,
      "reg_number": "Bus-1",
      "seats": 25,
      "is_female_only": 0,
      "created_at": "2026-04-13 07:27:38"
    },
    {
      "id": 11,
      "reg_number": "Bus-2",
      "seats": 25,
      "is_female_only": 0,
      "created_at": "2026-04-13 07:27:46"
    },
    {
      "id": 12,
      "reg_number": "Bus-3",
      "seats": 25,
      "is_female_only": 0,
      "created_at": "2026-04-13 07:27:57"
    },
    {
      "id": 13,
      "reg_number": "Bus-4",
      "seats": 25,
      "is_female_only": 0,
      "created_at": "2026-04-13 07:28:06"
    },
    {
      "id": 14,
      "reg_number": "Bus-5",
      "seats": 25,
      "is_female_only": 1,
      "created_at": "2026-04-13 07:28:12"
    },
    {
      "id": 15,
      "reg_number": "Bus-6",
      "seats": 25,
      "is_female_only": 1,
      "created_at": "2026-04-13 07:28:20"
    }
  ],
  "bus_assignments": [
    {
      "id": 12,
      "bus_id": 10,
      "destination_id": 6,
      "time_id": 8
    },
    {
      "id": 13,
      "bus_id": 10,
      "destination_id": 7,
      "time_id": 9
    },
    {
      "id": 14,
      "bus_id": 10,
      "destination_id": 8,
      "time_id": 10
    },
    {
      "id": 15,
      "bus_id": 10,
      "destination_id": 9,
      "time_id": 11
    },
    {
      "id": 16,
      "bus_id": 10,
      "destination_id": 10,
      "time_id": 12
    },
    {
      "id": 17,
      "bus_id": 11,
      "destination_id": 11,
      "time_id": 13
    },
    {
      "id": 18,
      "bus_id": 11,
      "destination_id": 12,
      "time_id": 14
    },
    {
      "id": 19,
      "bus_id": 11,
      "destination_id": 13,
      "time_id": 15
    },
    {
      "id": 20,
      "bus_id": 11,
      "destination_id": 14,
      "time_id": 16
    },
    {
      "id": 21,
      "bus_id": 11,
      "destination_id": 15,
      "time_id": 17
    },
    {
      "id": 22,
      "bus_id": 11,
      "destination_id": 16,
      "time_id": 18
    },
    {
      "id": 23,
      "bus_id": 11,
      "destination_id": 17,
      "time_id": 19
    },
    {
      "id": 24,
      "bus_id": 12,
      "destination_id": 18,
      "time_id": 20
    },
    {
      "id": 25,
      "bus_id": 12,
      "destination_id": 19,
      "time_id": 21
    },
    {
      "id": 26,
      "bus_id": 12,
      "destination_id": 20,
      "time_id": 22
    },
    {
      "id": 27,
      "bus_id": 12,
      "destination_id": 21,
      "time_id": 23
    },
    {
      "id": 28,
      "bus_id": 12,
      "destination_id": 22,
      "time_id": 24
    },
    {
      "id": 29,
      "bus_id": 12,
      "destination_id": 23,
      "time_id": 25
    },
    {
      "id": 30,
      "bus_id": 13,
      "destination_id": 24,
      "time_id": 26
    },
    {
      "id": 31,
      "bus_id": 13,
      "destination_id": 25,
      "time_id": 27
    },
    {
      "id": 32,
      "bus_id": 13,
      "destination_id": 26,
      "time_id": 28
    },
    {
      "id": 33,
      "bus_id": 13,
      "destination_id": 27,
      "time_id": 29
    },
    {
      "id": 34,
      "bus_id": 14,
      "destination_id": 28,
      "time_id": 30
    },
    {
      "id": 35,
      "bus_id": 14,
      "destination_id": 29,
      "time_id": 31
    },
    {
      "id": 36,
      "bus_id": 14,
      "destination_id": 30,
      "time_id": 32
    },
    {
      "id": 37,
      "bus_id": 14,
      "destination_id": 31,
      "time_id": 33
    },
    {
      "id": 38,
      "bus_id": 14,
      "destination_id": 32,
      "time_id": 34
    },
    {
      "id": 39,
      "bus_id": 15,
      "destination_id": 33,
      "time_id": 35
    },
    {
      "id": 40,
      "bus_id": 15,
      "destination_id": 34,
      "time_id": 36
    },
    {
      "id": 41,
      "bus_id": 15,
      "destination_id": 35,
      "time_id": 37
    },
    {
      "id": 42,
      "bus_id": 15,
      "destination_id": 36,
      "time_id": 38
    },
    {
      "id": 43,
      "bus_id": 15,
      "destination_id": 37,
      "time_id": 39
    },
    {
      "id": 44,
      "bus_id": 15,
      "destination_id": 38,
      "time_id": 40
    }
  ],
  "bus_times": [
    {
      "id": 6,
      "destination_id": 6,
      "time": "07:40:00"
    },
    {
      "id": 7,
      "destination_id": 6,
      "time": "14:20:00"
    },
    {
      "id": 8,
      "destination_id": 6,
      "time": "10:00:00"
    },
    {
      "id": 9,
      "destination_id": 7,
      "time": "10:00:00"
    },
    {
      "id": 10,
      "destination_id": 8,
      "time": "10:00:00"
    },
    {
      "id": 11,
      "destination_id": 9,
      "time": "10:00:00"
    },
    {
      "id": 12,
      "destination_id": 10,
      "time": "10:00:00"
    },
    {
      "id": 13,
      "destination_id": 11,
      "time": "10:00:00"
    },
    {
      "id": 14,
      "destination_id": 12,
      "time": "10:00:00"
    },
    {
      "id": 15,
      "destination_id": 13,
      "time": "10:00:00"
    },
    {
      "id": 16,
      "destination_id": 14,
      "time": "10:00:00"
    },
    {
      "id": 17,
      "destination_id": 15,
      "time": "10:00:00"
    },
    {
      "id": 18,
      "destination_id": 16,
      "time": "10:00:00"
    },
    {
      "id": 19,
      "destination_id": 17,
      "time": "10:00:00"
    },
    {
      "id": 20,
      "destination_id": 18,
      "time": "10:00:00"
    },
    {
      "id": 21,
      "destination_id": 19,
      "time": "10:00:00"
    },
    {
      "id": 22,
      "destination_id": 20,
      "time": "10:00:00"
    },
    {
      "id": 23,
      "destination_id": 21,
      "time": "10:00:00"
    },
    {
      "id": 24,
      "destination_id": 22,
      "time": "10:00:00"
    },
    {
      "id": 25,
      "destination_id": 23,
      "time": "10:00:00"
    },
    {
      "id": 26,
      "destination_id": 24,
      "time": "10:00:00"
    },
    {
      "id": 27,
      "destination_id": 25,
      "time": "10:00:00"
    },
    {
      "id": 28,
      "destination_id": 26,
      "time": "10:00:00"
    },
    {
      "id": 29,
      "destination_id": 27,
      "time": "10:00:00"
    },
    {
      "id": 30,
      "destination_id": 28,
      "time": "10:00:00"
    },
    {
      "id": 31,
      "destination_id": 29,
      "time": "10:00:00"
    },
    {
      "id": 32,
      "destination_id": 30,
      "time": "10:00:00"
    },
    {
      "id": 33,
      "destination_id": 31,
      "time": "10:00:00"
    },
    {
      "id": 34,
      "destination_id": 32,
      "time": "10:00:00"
    },
    {
      "id": 35,
      "destination_id": 33,
      "time": "10:00:00"
    },
    {
      "id": 36,
      "destination_id": 34,
      "time": "10:00:00"
    },
    {
      "id": 37,
      "destination_id": 35,
      "time": "10:00:00"
    },
    {
      "id": 38,
      "destination_id": 36,
      "time": "10:00:00"
    },
    {
      "id": 39,
      "destination_id": 37,
      "time": "10:00:00"
    },
    {
      "id": 40,
      "destination_id": 38,
      "time": "10:00:00"
    },
    {
      "id": 71,
      "destination_id": 6,
      "time": "14:40:00"
    },
    {
      "id": 72,
      "destination_id": 7,
      "time": "14:40:00"
    },
    {
      "id": 73,
      "destination_id": 8,
      "time": "14:40:00"
    },
    {
      "id": 74,
      "destination_id": 9,
      "time": "14:40:00"
    },
    {
      "id": 75,
      "destination_id": 10,
      "time": "14:40:00"
    },
    {
      "id": 76,
      "destination_id": 11,
      "time": "14:40:00"
    },
    {
      "id": 77,
      "destination_id": 12,
      "time": "14:40:00"
    },
    {
      "id": 78,
      "destination_id": 13,
      "time": "14:40:00"
    },
    {
      "id": 79,
      "destination_id": 14,
      "time": "14:40:00"
    },
    {
      "id": 80,
      "destination_id": 15,
      "time": "14:40:00"
    },
    {
      "id": 81,
      "destination_id": 16,
      "time": "14:40:00"
    },
    {
      "id": 82,
      "destination_id": 17,
      "time": "14:40:00"
    },
    {
      "id": 83,
      "destination_id": 18,
      "time": "14:40:00"
    },
    {
      "id": 84,
      "destination_id": 19,
      "time": "14:40:00"
    },
    {
      "id": 85,
      "destination_id": 20,
      "time": "14:40:00"
    },
    {
      "id": 86,
      "destination_id": 21,
      "time": "14:40:00"
    },
    {
      "id": 87,
      "destination_id": 22,
      "time": "14:40:00"
    },
    {
      "id": 88,
      "destination_id": 23,
      "time": "14:40:00"
    },
    {
      "id": 89,
      "destination_id": 24,
      "time": "14:40:00"
    },
    {
      "id": 90,
      "destination_id": 25,
      "time": "14:40:00"
    },
    {
      "id": 91,
      "destination_id": 26,
      "time": "14:40:00"
    },
    {
      "id": 92,
      "destination_id": 27,
      "time": "14:40:00"
    },
    {
      "id": 93,
      "destination_id": 28,
      "time": "14:40:00"
    },
    {
      "id": 94,
      "destination_id": 29,
      "time": "14:40:00"
    },
    {
      "id": 95,
      "destination_id": 30,
      "time": "14:40:00"
    },
    {
      "id": 96,
      "destination_id": 31,
      "time": "14:40:00"
    },
    {
      "id": 97,
      "destination_id": 32,
      "time": "14:40:00"
    },
    {
      "id": 98,
      "destination_id": 33,
      "time": "14:40:00"
    },
    {
      "id": 99,
      "destination_id": 34,
      "time": "14:40:00"
    },
    {
      "id": 100,
      "destination_id": 35,
      "time": "14:40:00"
    },
    {
      "id": 101,
      "destination_id": 36,
      "time": "14:40:00"
    },
    {
      "id": 102,
      "destination_id": 37,
      "time": "14:40:00"
    },
    {
      "id": 103,
      "destination_id": 38,
      "time": "14:40:00"
    },
    {
      "id": 134,
      "destination_id": 6,
      "time": "18:30:00"
    },
    {
      "id": 135,
      "destination_id": 7,
      "time": "18:30:00"
    },
    {
      "id": 136,
      "destination_id": 8,
      "time": "18:30:00"
    },
    {
      "id": 137,
      "destination_id": 9,
      "time": "18:30:00"
    },
    {
      "id": 138,
      "destination_id": 10,
      "time": "18:30:00"
    },
    {
      "id": 139,
      "destination_id": 11,
      "time": "18:30:00"
    },
    {
      "id": 140,
      "destination_id": 12,
      "time": "18:30:00"
    },
    {
      "id": 141,
      "destination_id": 13,
      "time": "18:30:00"
    },
    {
      "id": 142,
      "destination_id": 14,
      "time": "18:30:00"
    },
    {
      "id": 143,
      "destination_id": 15,
      "time": "18:30:00"
    },
    {
      "id": 144,
      "destination_id": 16,
      "time": "18:30:00"
    },
    {
      "id": 145,
      "destination_id": 17,
      "time": "18:30:00"
    },
    {
      "id": 146,
      "destination_id": 18,
      "time": "18:30:00"
    },
    {
      "id": 147,
      "destination_id": 19,
      "time": "18:30:00"
    },
    {
      "id": 148,
      "destination_id": 20,
      "time": "18:30:00"
    },
    {
      "id": 149,
      "destination_id": 21,
      "time": "18:30:00"
    },
    {
      "id": 150,
      "destination_id": 22,
      "time": "18:30:00"
    },
    {
      "id": 151,
      "destination_id": 23,
      "time": "18:30:00"
    },
    {
      "id": 152,
      "destination_id": 24,
      "time": "18:30:00"
    },
    {
      "id": 153,
      "destination_id": 25,
      "time": "18:30:00"
    },
    {
      "id": 154,
      "destination_id": 26,
      "time": "18:30:00"
    },
    {
      "id": 155,
      "destination_id": 27,
      "time": "18:30:00"
    },
    {
      "id": 156,
      "destination_id": 28,
      "time": "18:30:00"
    },
    {
      "id": 157,
      "destination_id": 29,
      "time": "18:30:00"
    },
    {
      "id": 158,
      "destination_id": 30,
      "time": "18:30:00"
    },
    {
      "id": 159,
      "destination_id": 31,
      "time": "18:30:00"
    },
    {
      "id": 160,
      "destination_id": 32,
      "time": "18:30:00"
    },
    {
      "id": 161,
      "destination_id": 33,
      "time": "18:30:00"
    },
    {
      "id": 162,
      "destination_id": 34,
      "time": "18:30:00"
    },
    {
      "id": 163,
      "destination_id": 35,
      "time": "18:30:00"
    },
    {
      "id": 164,
      "destination_id": 36,
      "time": "18:30:00"
    },
    {
      "id": 165,
      "destination_id": 37,
      "time": "18:30:00"
    },
    {
      "id": 166,
      "destination_id": 38,
      "time": "18:30:00"
    },
    {
      "id": 197,
      "destination_id": 6,
      "time": "22:20:00"
    },
    {
      "id": 198,
      "destination_id": 7,
      "time": "22:20:00"
    },
    {
      "id": 199,
      "destination_id": 8,
      "time": "22:20:00"
    },
    {
      "id": 200,
      "destination_id": 9,
      "time": "22:20:00"
    },
    {
      "id": 201,
      "destination_id": 10,
      "time": "22:20:00"
    },
    {
      "id": 202,
      "destination_id": 11,
      "time": "22:20:00"
    },
    {
      "id": 203,
      "destination_id": 12,
      "time": "22:20:00"
    },
    {
      "id": 204,
      "destination_id": 13,
      "time": "22:20:00"
    },
    {
      "id": 205,
      "destination_id": 14,
      "time": "22:20:00"
    },
    {
      "id": 206,
      "destination_id": 15,
      "time": "22:20:00"
    },
    {
      "id": 207,
      "destination_id": 16,
      "time": "22:20:00"
    },
    {
      "id": 208,
      "destination_id": 17,
      "time": "22:20:00"
    },
    {
      "id": 209,
      "destination_id": 18,
      "time": "22:20:00"
    },
    {
      "id": 210,
      "destination_id": 19,
      "time": "22:20:00"
    },
    {
      "id": 211,
      "destination_id": 20,
      "time": "22:20:00"
    },
    {
      "id": 212,
      "destination_id": 21,
      "time": "22:20:00"
    },
    {
      "id": 213,
      "destination_id": 22,
      "time": "22:20:00"
    },
    {
      "id": 214,
      "destination_id": 23,
      "time": "22:20:00"
    },
    {
      "id": 215,
      "destination_id": 24,
      "time": "22:20:00"
    },
    {
      "id": 216,
      "destination_id": 25,
      "time": "22:20:00"
    },
    {
      "id": 217,
      "destination_id": 26,
      "time": "22:20:00"
    },
    {
      "id": 218,
      "destination_id": 27,
      "time": "22:20:00"
    },
    {
      "id": 219,
      "destination_id": 28,
      "time": "22:20:00"
    },
    {
      "id": 220,
      "destination_id": 29,
      "time": "22:20:00"
    },
    {
      "id": 221,
      "destination_id": 30,
      "time": "22:20:00"
    },
    {
      "id": 222,
      "destination_id": 31,
      "time": "22:20:00"
    },
    {
      "id": 223,
      "destination_id": 32,
      "time": "22:20:00"
    },
    {
      "id": 224,
      "destination_id": 33,
      "time": "22:20:00"
    },
    {
      "id": 225,
      "destination_id": 34,
      "time": "22:20:00"
    },
    {
      "id": 226,
      "destination_id": 35,
      "time": "22:20:00"
    },
    {
      "id": 227,
      "destination_id": 36,
      "time": "22:20:00"
    },
    {
      "id": 228,
      "destination_id": 37,
      "time": "22:20:00"
    },
    {
      "id": 229,
      "destination_id": 38,
      "time": "22:20:00"
    },
    {
      "id": 260,
      "destination_id": 39,
      "time": "07:40:00"
    },
    {
      "id": 261,
      "destination_id": 40,
      "time": "07:40:00"
    },
    {
      "id": 262,
      "destination_id": 41,
      "time": "07:40:00"
    },
    {
      "id": 263,
      "destination_id": 42,
      "time": "07:40:00"
    },
    {
      "id": 264,
      "destination_id": 43,
      "time": "07:40:00"
    },
    {
      "id": 265,
      "destination_id": 44,
      "time": "07:40:00"
    },
    {
      "id": 266,
      "destination_id": 45,
      "time": "07:40:00"
    },
    {
      "id": 267,
      "destination_id": 46,
      "time": "07:40:00"
    },
    {
      "id": 268,
      "destination_id": 47,
      "time": "07:40:00"
    },
    {
      "id": 269,
      "destination_id": 48,
      "time": "07:40:00"
    },
    {
      "id": 270,
      "destination_id": 49,
      "time": "07:40:00"
    },
    {
      "id": 271,
      "destination_id": 50,
      "time": "07:40:00"
    },
    {
      "id": 272,
      "destination_id": 51,
      "time": "07:40:00"
    },
    {
      "id": 273,
      "destination_id": 52,
      "time": "07:40:00"
    },
    {
      "id": 274,
      "destination_id": 53,
      "time": "07:40:00"
    },
    {
      "id": 275,
      "destination_id": 54,
      "time": "07:40:00"
    },
    {
      "id": 276,
      "destination_id": 55,
      "time": "07:40:00"
    },
    {
      "id": 277,
      "destination_id": 56,
      "time": "07:40:00"
    },
    {
      "id": 278,
      "destination_id": 57,
      "time": "07:40:00"
    },
    {
      "id": 279,
      "destination_id": 58,
      "time": "07:40:00"
    },
    {
      "id": 280,
      "destination_id": 59,
      "time": "07:40:00"
    },
    {
      "id": 281,
      "destination_id": 60,
      "time": "07:40:00"
    },
    {
      "id": 282,
      "destination_id": 61,
      "time": "07:40:00"
    },
    {
      "id": 283,
      "destination_id": 62,
      "time": "07:40:00"
    },
    {
      "id": 284,
      "destination_id": 63,
      "time": "07:40:00"
    },
    {
      "id": 285,
      "destination_id": 64,
      "time": "07:40:00"
    },
    {
      "id": 286,
      "destination_id": 65,
      "time": "07:40:00"
    },
    {
      "id": 287,
      "destination_id": 66,
      "time": "07:40:00"
    },
    {
      "id": 288,
      "destination_id": 67,
      "time": "07:40:00"
    },
    {
      "id": 289,
      "destination_id": 68,
      "time": "07:40:00"
    },
    {
      "id": 290,
      "destination_id": 69,
      "time": "07:40:00"
    },
    {
      "id": 291,
      "destination_id": 70,
      "time": "07:40:00"
    },
    {
      "id": 292,
      "destination_id": 71,
      "time": "07:40:00"
    },
    {
      "id": 323,
      "destination_id": 39,
      "time": "14:20:00"
    },
    {
      "id": 324,
      "destination_id": 40,
      "time": "14:20:00"
    },
    {
      "id": 325,
      "destination_id": 41,
      "time": "14:20:00"
    },
    {
      "id": 326,
      "destination_id": 42,
      "time": "14:20:00"
    },
    {
      "id": 327,
      "destination_id": 43,
      "time": "14:20:00"
    },
    {
      "id": 328,
      "destination_id": 44,
      "time": "14:20:00"
    },
    {
      "id": 329,
      "destination_id": 45,
      "time": "14:20:00"
    },
    {
      "id": 330,
      "destination_id": 46,
      "time": "14:20:00"
    },
    {
      "id": 331,
      "destination_id": 47,
      "time": "14:20:00"
    },
    {
      "id": 332,
      "destination_id": 48,
      "time": "14:20:00"
    },
    {
      "id": 333,
      "destination_id": 49,
      "time": "14:20:00"
    },
    {
      "id": 334,
      "destination_id": 50,
      "time": "14:20:00"
    },
    {
      "id": 335,
      "destination_id": 51,
      "time": "14:20:00"
    },
    {
      "id": 336,
      "destination_id": 52,
      "time": "14:20:00"
    },
    {
      "id": 337,
      "destination_id": 53,
      "time": "14:20:00"
    },
    {
      "id": 338,
      "destination_id": 54,
      "time": "14:20:00"
    },
    {
      "id": 339,
      "destination_id": 55,
      "time": "14:20:00"
    },
    {
      "id": 340,
      "destination_id": 56,
      "time": "14:20:00"
    },
    {
      "id": 341,
      "destination_id": 57,
      "time": "14:20:00"
    },
    {
      "id": 342,
      "destination_id": 58,
      "time": "14:20:00"
    },
    {
      "id": 343,
      "destination_id": 59,
      "time": "14:20:00"
    },
    {
      "id": 344,
      "destination_id": 60,
      "time": "14:20:00"
    },
    {
      "id": 345,
      "destination_id": 61,
      "time": "14:20:00"
    },
    {
      "id": 346,
      "destination_id": 62,
      "time": "14:20:00"
    },
    {
      "id": 347,
      "destination_id": 63,
      "time": "14:20:00"
    },
    {
      "id": 348,
      "destination_id": 64,
      "time": "14:20:00"
    },
    {
      "id": 349,
      "destination_id": 65,
      "time": "14:20:00"
    },
    {
      "id": 350,
      "destination_id": 66,
      "time": "14:20:00"
    },
    {
      "id": 351,
      "destination_id": 67,
      "time": "14:20:00"
    },
    {
      "id": 352,
      "destination_id": 68,
      "time": "14:20:00"
    },
    {
      "id": 353,
      "destination_id": 69,
      "time": "14:20:00"
    },
    {
      "id": 354,
      "destination_id": 70,
      "time": "14:20:00"
    },
    {
      "id": 355,
      "destination_id": 71,
      "time": "14:20:00"
    },
    {
      "id": 386,
      "destination_id": 39,
      "time": "17:45:00"
    },
    {
      "id": 387,
      "destination_id": 40,
      "time": "17:45:00"
    },
    {
      "id": 388,
      "destination_id": 41,
      "time": "17:45:00"
    },
    {
      "id": 389,
      "destination_id": 42,
      "time": "17:45:00"
    },
    {
      "id": 390,
      "destination_id": 43,
      "time": "17:45:00"
    },
    {
      "id": 391,
      "destination_id": 44,
      "time": "17:45:00"
    },
    {
      "id": 392,
      "destination_id": 45,
      "time": "17:45:00"
    },
    {
      "id": 393,
      "destination_id": 46,
      "time": "17:45:00"
    },
    {
      "id": 394,
      "destination_id": 47,
      "time": "17:45:00"
    },
    {
      "id": 395,
      "destination_id": 48,
      "time": "17:45:00"
    },
    {
      "id": 396,
      "destination_id": 49,
      "time": "17:45:00"
    },
    {
      "id": 397,
      "destination_id": 50,
      "time": "17:45:00"
    },
    {
      "id": 398,
      "destination_id": 51,
      "time": "17:45:00"
    },
    {
      "id": 399,
      "destination_id": 52,
      "time": "17:45:00"
    },
    {
      "id": 400,
      "destination_id": 53,
      "time": "17:45:00"
    },
    {
      "id": 401,
      "destination_id": 54,
      "time": "17:45:00"
    },
    {
      "id": 402,
      "destination_id": 55,
      "time": "17:45:00"
    },
    {
      "id": 403,
      "destination_id": 56,
      "time": "17:45:00"
    },
    {
      "id": 404,
      "destination_id": 57,
      "time": "17:45:00"
    },
    {
      "id": 405,
      "destination_id": 58,
      "time": "17:45:00"
    },
    {
      "id": 406,
      "destination_id": 59,
      "time": "17:45:00"
    },
    {
      "id": 407,
      "destination_id": 60,
      "time": "17:45:00"
    },
    {
      "id": 408,
      "destination_id": 61,
      "time": "17:45:00"
    },
    {
      "id": 409,
      "destination_id": 62,
      "time": "17:45:00"
    },
    {
      "id": 410,
      "destination_id": 63,
      "time": "17:45:00"
    },
    {
      "id": 411,
      "destination_id": 64,
      "time": "17:45:00"
    },
    {
      "id": 412,
      "destination_id": 65,
      "time": "17:45:00"
    },
    {
      "id": 413,
      "destination_id": 66,
      "time": "17:45:00"
    },
    {
      "id": 414,
      "destination_id": 67,
      "time": "17:45:00"
    },
    {
      "id": 415,
      "destination_id": 68,
      "time": "17:45:00"
    },
    {
      "id": 416,
      "destination_id": 69,
      "time": "17:45:00"
    },
    {
      "id": 417,
      "destination_id": 70,
      "time": "17:45:00"
    },
    {
      "id": 418,
      "destination_id": 71,
      "time": "17:45:00"
    },
    {
      "id": 449,
      "destination_id": 39,
      "time": "18:45:00"
    },
    {
      "id": 450,
      "destination_id": 40,
      "time": "18:45:00"
    },
    {
      "id": 451,
      "destination_id": 41,
      "time": "18:45:00"
    },
    {
      "id": 452,
      "destination_id": 42,
      "time": "18:45:00"
    },
    {
      "id": 453,
      "destination_id": 43,
      "time": "18:45:00"
    },
    {
      "id": 454,
      "destination_id": 44,
      "time": "18:45:00"
    },
    {
      "id": 455,
      "destination_id": 45,
      "time": "18:45:00"
    },
    {
      "id": 456,
      "destination_id": 46,
      "time": "18:45:00"
    },
    {
      "id": 457,
      "destination_id": 47,
      "time": "18:45:00"
    },
    {
      "id": 458,
      "destination_id": 48,
      "time": "18:45:00"
    },
    {
      "id": 459,
      "destination_id": 49,
      "time": "18:45:00"
    },
    {
      "id": 460,
      "destination_id": 50,
      "time": "18:45:00"
    },
    {
      "id": 461,
      "destination_id": 51,
      "time": "18:45:00"
    },
    {
      "id": 462,
      "destination_id": 52,
      "time": "18:45:00"
    },
    {
      "id": 463,
      "destination_id": 53,
      "time": "18:45:00"
    },
    {
      "id": 464,
      "destination_id": 54,
      "time": "18:45:00"
    },
    {
      "id": 465,
      "destination_id": 55,
      "time": "18:45:00"
    },
    {
      "id": 466,
      "destination_id": 56,
      "time": "18:45:00"
    },
    {
      "id": 467,
      "destination_id": 57,
      "time": "18:45:00"
    },
    {
      "id": 468,
      "destination_id": 58,
      "time": "18:45:00"
    },
    {
      "id": 469,
      "destination_id": 59,
      "time": "18:45:00"
    },
    {
      "id": 470,
      "destination_id": 60,
      "time": "18:45:00"
    },
    {
      "id": 471,
      "destination_id": 61,
      "time": "18:45:00"
    },
    {
      "id": 472,
      "destination_id": 62,
      "time": "18:45:00"
    },
    {
      "id": 473,
      "destination_id": 63,
      "time": "18:45:00"
    },
    {
      "id": 474,
      "destination_id": 64,
      "time": "18:45:00"
    },
    {
      "id": 475,
      "destination_id": 65,
      "time": "18:45:00"
    },
    {
      "id": 476,
      "destination_id": 66,
      "time": "18:45:00"
    },
    {
      "id": 477,
      "destination_id": 67,
      "time": "18:45:00"
    },
    {
      "id": 478,
      "destination_id": 68,
      "time": "18:45:00"
    },
    {
      "id": 479,
      "destination_id": 69,
      "time": "18:45:00"
    },
    {
      "id": 480,
      "destination_id": 70,
      "time": "18:45:00"
    },
    {
      "id": 481,
      "destination_id": 71,
      "time": "18:45:00"
    }
  ],
  "destinations": [
    {
      "id": 6,
      "name": "NSU-Abdullahpur (Polwel Market)",
      "distance": 9.8,
      "fare": 100.0,
      "created_at": "2026-04-13 06:07:08",
      "start_map_coords": "23.8151,90.4230",
      "start_destination": "NSU",
      "end_destination": "Abdullahpur (Polwel Market)",
      "end_map_coords": "23.8798,90.4011"
    },
    {
      "id": 7,
      "name": "NSU-Uttara House Building (Janata Bank)",
      "distance": 9.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:08:41",
      "start_map_coords": "23.8151,90.4230",
      "start_destination": "NSU",
      "end_destination": "Uttara House Building (Janata Bank)",
      "end_map_coords": "23.8747,90.4004"
    },
    {
      "id": 8,
      "name": "NSU-Uttara Azampur (Uttara East Thana)",
      "distance": 8.5,
      "fare": 100.0,
      "created_at": "2026-04-13 06:11:42",
      "start_map_coords": "23.8151,90.4230",
      "start_destination": "NSU",
      "end_destination": "Uttara Azampur (Uttara East Thana)",
      "end_map_coords": "23.8643,90.3999"
    },
    {
      "id": 9,
      "name": "NSU-Uttara Jashimuddin (Foot Over Bridge RAB-1)",
      "distance": 8.9,
      "fare": 100.0,
      "created_at": "2026-04-13 06:15:03",
      "start_map_coords": "23.8151,90.4230",
      "start_destination": "NSU",
      "end_destination": "Uttara Jashimuddin (Foot Over Bridge RAB-1)",
      "end_map_coords": "23.8613,90.3928"
    },
    {
      "id": 10,
      "name": "NSU-Airport (Traffic Police Box)",
      "distance": 6.5,
      "fare": 100.0,
      "created_at": "2026-04-13 06:16:44",
      "start_map_coords": "23.8151,90.4230",
      "start_destination": "NSU",
      "end_destination": "Airport (Traffic Police Box)",
      "end_map_coords": "23.8502,90.4084"
    },
    {
      "id": 11,
      "name": "NSU-Mirpur Bangla College (Foot Over Bridge)",
      "distance": 17.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:21:33",
      "start_map_coords": "23.8151,90.4230",
      "start_destination": "NSU",
      "end_destination": "Mirpur Bangla College (Foot Over Bridge)",
      "end_map_coords": "23.7917,90.3497"
    },
    {
      "id": 12,
      "name": "NSU-Mirpur-1 (New Market)",
      "distance": 13.4,
      "fare": 100.0,
      "created_at": "2026-04-13 06:23:32",
      "start_map_coords": "23.8151,90.4230",
      "start_destination": "NSU",
      "end_destination": "Mirpur-1 (New Market)",
      "end_map_coords": "23.7967,90.3511"
    },
    {
      "id": 13,
      "name": "NSU-Mirpur-2 (National Bangla High School)",
      "distance": 10.9,
      "fare": 100.0,
      "created_at": "2026-04-13 06:24:32",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Mirpur-2 (National Bangla High School)",
      "end_map_coords": "23.8067483,90.3769734"
    },
    {
      "id": 14,
      "name": "NSU-Mirpur-10 (Metro Rail Station)",
      "distance": 11.1,
      "fare": 100.0,
      "created_at": "2026-04-13 06:26:01",
      "start_map_coords": "23.8151,90.4230",
      "start_destination": "NSU",
      "end_destination": "Mirpur-10 (Metro Rail Station)",
      "end_map_coords": "23.8077,90.3658"
    },
    {
      "id": 15,
      "name": "NSU-Mirpur-11 (Metro Rail Station)",
      "distance": 11.1,
      "fare": 100.0,
      "created_at": "2026-04-13 06:27:19",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Mirpur-11 (Metro Rail Station)",
      "end_map_coords": "23.8183388,90.3769734"
    },
    {
      "id": 16,
      "name": "NSU-Mirpur-12 (CNG Station/ Mirpur Ceramic)",
      "distance": 10.2,
      "fare": 100.0,
      "created_at": "2026-04-13 06:28:18",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Mirpur-12 (CNG Station/ Mirpur Ceramic)",
      "end_map_coords": "23.8225976,90.3764589"
    },
    {
      "id": 17,
      "name": "NSU-ECB Square (Jatri Chhawni)",
      "distance": 6.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:29:06",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "ECB Square (Jatri Chhawni)",
      "end_map_coords": "23.8224267,90.4013304"
    },
    {
      "id": 18,
      "name": "NSU-Mohammadpur (Japan Garden City)",
      "distance": 15.6,
      "fare": 100.0,
      "created_at": "2026-04-13 06:30:32",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Mohammadpur (Japan Garden City)",
      "end_map_coords": "23.7917413,90.3525791"
    },
    {
      "id": 19,
      "name": "NSU-Mohammadpur Opposite of Suchana Community Center (Probal Housing)",
      "distance": 15.7,
      "fare": 100.0,
      "created_at": "2026-04-13 06:32:07",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Mohammadpur Opposite of Suchana Community Center (Probal Housing)",
      "end_map_coords": "23.7917413,90.3530616"
    },
    {
      "id": 20,
      "name": "NSU-Syamoli Bus Stand (Hotel Mohammadia)",
      "distance": 15.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:32:55",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Syamoli Bus Stand (Hotel Mohammadia)",
      "end_map_coords": "23.7917413,90.3564441"
    },
    {
      "id": 21,
      "name": "NSU-Agargoan Metro Rail Station",
      "distance": 12.8,
      "fare": 100.0,
      "created_at": "2026-04-13 06:34:42",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Agargoan Metro Rail Station",
      "end_map_coords": "23.7891108,90.3638412"
    },
    {
      "id": 22,
      "name": "NSU-BAF Shaheen College",
      "distance": 9.8,
      "fare": 100.0,
      "created_at": "2026-04-13 06:35:36",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "BAF Shaheen College",
      "end_map_coords": "23.8007472,90.3893282"
    },
    {
      "id": 23,
      "name": "NSU-Banani Rail Station",
      "distance": 8.7,
      "fare": 100.0,
      "created_at": "2026-04-13 06:36:16",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Banani Rail Station",
      "end_map_coords": "23.8067483,90.3942694"
    },
    {
      "id": 24,
      "name": "NSU-Jigatola Bus Stand (Japan Bangladesh Hospital)",
      "distance": 16.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:37:06",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Jigatola Bus Stand (Japan Bangladesh Hospital)",
      "end_map_coords": "23.7799405,90.3610189"
    },
    {
      "id": 25,
      "name": "NSU-Dhanmondi-27 (Rapa Plaza)",
      "distance": 14.2,
      "fare": 100.0,
      "created_at": "2026-04-13 06:38:14",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Dhanmondi-27 (Rapa Plaza)",
      "end_map_coords": "23.7894923,90.3609005"
    },
    {
      "id": 26,
      "name": "NSU-Khamarbari Mor",
      "distance": 12.4,
      "fare": 100.0,
      "created_at": "2026-04-13 06:39:06",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Khamarbari Mor",
      "end_map_coords": "23.7917413,90.3655042"
    },
    {
      "id": 27,
      "name": "NSU-Mohakhali Fly Over (Banani End)",
      "distance": 10.7,
      "fare": 100.0,
      "created_at": "2026-04-13 06:40:50",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Mohakhali Fly Over (Banani End)",
      "end_map_coords": "23.8007472,90.3893282"
    },
    {
      "id": 28,
      "name": "NSU-Azimpur (Matri Sadan Hospital)",
      "distance": 18.1,
      "fare": 100.0,
      "created_at": "2026-04-13 06:41:56",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Azimpur (Matri Sadan Hospital)",
      "end_map_coords": "23.776547,90.3655859"
    },
    {
      "id": 29,
      "name": "NSU-Katabon Bus Stand",
      "distance": 16.4,
      "fare": 100.0,
      "created_at": "2026-04-13 06:42:48",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Katabon Bus Stand",
      "end_map_coords": "23.7389539,90.3903245"
    },
    {
      "id": 30,
      "name": "NSU-Bangla Motor Pharmacy Council Office",
      "distance": 14.8,
      "fare": 100.0,
      "created_at": "2026-04-13 06:43:44",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Bangla Motor Pharmacy Council Office",
      "end_map_coords": "23.7860213,90.3673715"
    },
    {
      "id": 31,
      "name": "NSU-Mogbazar (NCC Bank)",
      "distance": 13.5,
      "fare": 100.0,
      "created_at": "2026-04-13 06:44:59",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Mogbazar (NCC Bank)",
      "end_map_coords": "23.7871432,90.3708776"
    },
    {
      "id": 32,
      "name": "NSU-Gulshan Niketon Gate-1 (Jatri Chhawni)",
      "distance": 15.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:45:41",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Gulshan Niketon Gate-1 (Jatri Chhawni)",
      "end_map_coords": "23.7891108,90.3708776"
    },
    {
      "id": 33,
      "name": "NSU-Notre Dame College",
      "distance": 16.4,
      "fare": 100.0,
      "created_at": "2026-04-13 06:46:21",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Notre Dame College",
      "end_map_coords": "23.7755631,90.3708776"
    },
    {
      "id": 34,
      "name": "NSU-Rajarbag Bus Stand",
      "distance": 14.6,
      "fare": 100.0,
      "created_at": "2026-04-13 06:47:04",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Rajarbag Bus Stand",
      "end_map_coords": "23.783185,90.3708776"
    },
    {
      "id": 35,
      "name": "NSU-Khilgaon Bagicha Jame Masjid",
      "distance": 16.1,
      "fare": 100.0,
      "created_at": "2026-04-13 06:47:48",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Khilgaon Bagicha Jame Masjid",
      "end_map_coords": "23.7831348,90.3708776"
    },
    {
      "id": 36,
      "name": "NSU-Malibagh Rail Gate (Ibne Sina Hospital)",
      "distance": 14.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:48:27",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Malibagh Rail Gate (Ibne Sina Hospital)",
      "end_map_coords": "23.7860042,90.3708776"
    },
    {
      "id": 37,
      "name": "NSU-Malibag Abul Hotel",
      "distance": 15.0,
      "fare": 100.0,
      "created_at": "2026-04-13 06:49:10",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Malibag Abul Hotel",
      "end_map_coords": "23.7859305,90.3708776"
    },
    {
      "id": 38,
      "name": "NSU-Rampura Bridge (Opposite of BTV)",
      "distance": 7.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:49:49",
      "start_map_coords": "23.8151107,90.4229817",
      "start_destination": "NSU",
      "end_destination": "Rampura Bridge (Opposite of BTV)",
      "end_map_coords": "23.7859305,90.3708776"
    },
    {
      "id": 39,
      "name": "Abdullahpur (Polwel Market)-NSU",
      "distance": 9.8,
      "fare": 100.0,
      "created_at": "2026-04-13 06:51:49",
      "start_map_coords": "23.8798,90.4011",
      "start_destination": "Abdullahpur (Polwel Market)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 40,
      "name": "Uttara House Building (Janata Bank)-NSU",
      "distance": 9.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:52:17",
      "start_map_coords": "23.8747,90.4004",
      "start_destination": "Uttara House Building (Janata Bank)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 41,
      "name": "Uttara Azampur (Uttara East Thana)-NSU",
      "distance": 8.5,
      "fare": 100.0,
      "created_at": "2026-04-13 06:53:00",
      "start_map_coords": "23.8643,90.3999",
      "start_destination": "Uttara Azampur (Uttara East Thana)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 42,
      "name": "Uttara Jashimuddin (Foot Over Bridge RAB-1)-NSU",
      "distance": 8.9,
      "fare": 100.0,
      "created_at": "2026-04-13 06:53:20",
      "start_map_coords": "23.8613,90.3928",
      "start_destination": "Uttara Jashimuddin (Foot Over Bridge RAB-1)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 43,
      "name": "Airport (Traffic Police Box)-NSU",
      "distance": 6.5,
      "fare": 100.0,
      "created_at": "2026-04-13 06:53:47",
      "start_map_coords": "23.8502,90.4084",
      "start_destination": "Airport (Traffic Police Box)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 44,
      "name": "Mirpur Bangla College (Foot Over Bridge)-NSU",
      "distance": 17.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:54:15",
      "start_map_coords": "23.7917,90.3497",
      "start_destination": "Mirpur Bangla College (Foot Over Bridge)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 45,
      "name": "Mirpur-1 (New Market)-NSU",
      "distance": 13.4,
      "fare": 100.0,
      "created_at": "2026-04-13 06:54:37",
      "start_map_coords": "23.7967,90.3511",
      "start_destination": "Mirpur-1 (New Market)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 46,
      "name": "Mirpur-2 (National Bangla High School)-NSU",
      "distance": 10.9,
      "fare": 100.0,
      "created_at": "2026-04-13 06:54:52",
      "start_map_coords": "23.8067,90.3770",
      "start_destination": "Mirpur-2 (National Bangla High School)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 47,
      "name": "Mirpur-10 (Metro Rail Station)-NSU",
      "distance": 11.1,
      "fare": 100.0,
      "created_at": "2026-04-13 06:55:14",
      "start_map_coords": "23.8077,90.3658",
      "start_destination": "Mirpur-10 (Metro Rail Station)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 48,
      "name": "Mirpur-11 (Metro Rail Station)-NSU",
      "distance": 11.1,
      "fare": 100.0,
      "created_at": "2026-04-13 06:55:32",
      "start_map_coords": "23.8183,90.3770",
      "start_destination": "Mirpur-11 (Metro Rail Station)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 49,
      "name": "Mirpur-12 (CNG Station/ Mirpur Ceramic)-NSU",
      "distance": 10.2,
      "fare": 100.0,
      "created_at": "2026-04-13 06:55:56",
      "start_map_coords": "23.8226,90.3765",
      "start_destination": "Mirpur-12 (CNG Station/ Mirpur Ceramic)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 50,
      "name": "ECB Square (Jatri Chhawni)-NSU",
      "distance": 6.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:56:17",
      "start_map_coords": "23.8224,90.4013",
      "start_destination": "ECB Square (Jatri Chhawni)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 51,
      "name": "Mohammadpur (Japan Garden City)-NSU",
      "distance": 15.6,
      "fare": 100.0,
      "created_at": "2026-04-13 06:56:36",
      "start_map_coords": "23.7917,90.3526",
      "start_destination": "Mohammadpur (Japan Garden City)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 52,
      "name": "Mohammadpur Opposite of Suchana Community Center (Probal Housing)-NSU",
      "distance": 15.7,
      "fare": 100.0,
      "created_at": "2026-04-13 06:56:58",
      "start_map_coords": "23.7917,90.3531",
      "start_destination": "Mohammadpur Opposite of Suchana Community Center (Probal Housing)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 53,
      "name": "Syamoli Bus Stand (Hotel Mohammadia)-NSU",
      "distance": 15.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:57:15",
      "start_map_coords": "23.7917,90.3564",
      "start_destination": "Syamoli Bus Stand (Hotel Mohammadia)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 54,
      "name": "Agargoan Metro Rail Station-NSU",
      "distance": 12.8,
      "fare": 100.0,
      "created_at": "2026-04-13 06:57:29",
      "start_map_coords": "23.7891,90.3638",
      "start_destination": "Agargoan Metro Rail Station",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 55,
      "name": "BAF Shaheen College-NSU",
      "distance": 9.8,
      "fare": 100.0,
      "created_at": "2026-04-13 06:57:47",
      "start_map_coords": "23.8007,90.3893",
      "start_destination": "BAF Shaheen College",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 56,
      "name": "Banani Rail Station-NSU",
      "distance": 8.7,
      "fare": 100.0,
      "created_at": "2026-04-13 06:58:04",
      "start_map_coords": "23.8067,90.3943",
      "start_destination": "Banani Rail Station",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 57,
      "name": "Jigatola Bus Stand (Japan Bangladesh Hospital)-NSU",
      "distance": 16.3,
      "fare": 100.0,
      "created_at": "2026-04-13 06:58:23",
      "start_map_coords": "23.7799,90.3610",
      "start_destination": "Jigatola Bus Stand (Japan Bangladesh Hospital)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 58,
      "name": "Dhanmondi-27 (Rapa Plaza)-NSU",
      "distance": 14.2,
      "fare": 100.0,
      "created_at": "2026-04-13 06:58:37",
      "start_map_coords": "23.7895,90.3609",
      "start_destination": "Dhanmondi-27 (Rapa Plaza)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 59,
      "name": "Khamarbari Mor-NSU",
      "distance": 12.4,
      "fare": 100.0,
      "created_at": "2026-04-13 06:58:57",
      "start_map_coords": "23.7917,90.3655",
      "start_destination": "Khamarbari Mor",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 60,
      "name": "Mohakhali Fly Over (Banani End)-NSU",
      "distance": 10.7,
      "fare": 100.0,
      "created_at": "2026-04-13 06:59:13",
      "start_map_coords": "23.8007,90.3893",
      "start_destination": "Mohakhali Fly Over (Banani End)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 61,
      "name": "Azimpur (Matri Sadan Hospital)-NSU",
      "distance": 18.1,
      "fare": 100.0,
      "created_at": "2026-04-13 06:59:35",
      "start_map_coords": "23.7765,90.3656",
      "start_destination": "Azimpur (Matri Sadan Hospital)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 62,
      "name": "Katabon Bus Stand-NSU",
      "distance": 16.4,
      "fare": 100.0,
      "created_at": "2026-04-13 06:59:55",
      "start_map_coords": "23.7390,90.3903",
      "start_destination": "Katabon Bus Stand",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 63,
      "name": "Bangla Motor Pharmacy Council Office-NSU",
      "distance": 14.8,
      "fare": 100.0,
      "created_at": "2026-04-13 07:00:10",
      "start_map_coords": "23.7860,90.3674",
      "start_destination": "Bangla Motor Pharmacy Council Office",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 64,
      "name": "Mogbazar (NCC Bank)-NSU",
      "distance": 13.5,
      "fare": 100.0,
      "created_at": "2026-04-13 07:00:29",
      "start_map_coords": "23.7871,90.3709",
      "start_destination": "Mogbazar (NCC Bank)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 65,
      "name": "Gulshan Niketon Gate-1 (Jatri Chhawni)-NSU",
      "distance": 15.3,
      "fare": 100.0,
      "created_at": "2026-04-13 07:00:44",
      "start_map_coords": "23.7891,90.3709",
      "start_destination": "Gulshan Niketon Gate-1 (Jatri Chhawni)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 66,
      "name": "Notre Dame College-NSU",
      "distance": 16.4,
      "fare": 100.0,
      "created_at": "2026-04-13 07:01:00",
      "start_map_coords": "23.7756,90.3709",
      "start_destination": "Notre Dame College",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 67,
      "name": "Rajarbag Bus Stand-NSU",
      "distance": 14.6,
      "fare": 100.0,
      "created_at": "2026-04-13 07:01:17",
      "start_map_coords": "23.7832,90.3709",
      "start_destination": "Rajarbag Bus Stand",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 68,
      "name": "Khilgaon Bagicha Jame Masjid-NSU",
      "distance": 16.1,
      "fare": 100.0,
      "created_at": "2026-04-13 07:01:34",
      "start_map_coords": "23.7831,90.3709",
      "start_destination": "Khilgaon Bagicha Jame Masjid",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 69,
      "name": "Malibagh Rail Gate (Ibne Sina Hospital)-NSU",
      "distance": 14.3,
      "fare": 14.3,
      "created_at": "2026-04-13 07:01:56",
      "start_map_coords": "23.7860,90.3709",
      "start_destination": "Malibagh Rail Gate (Ibne Sina Hospital)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 70,
      "name": "Malibag Abul Hotel-NSU",
      "distance": 15.0,
      "fare": 100.0,
      "created_at": "2026-04-13 07:02:12",
      "start_map_coords": "23.7859,90.3709",
      "start_destination": "Malibag Abul Hotel",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    },
    {
      "id": 71,
      "name": "Rampura Bridge (Opposite of BTV)-NSU",
      "distance": 7.3,
      "fare": 100.0,
      "created_at": "2026-04-13 07:02:26",
      "start_map_coords": "23.7859,90.3709",
      "start_destination": "Rampura Bridge (Opposite of BTV)",
      "end_destination": "NSU",
      "end_map_coords": "23.8151,90.4230"
    }
  ],
  "payment_options": [
    {
      "id": 1,
      "name": "online"
    },
    {
      "id": 2,
      "name": "cash"
    },
    {
      "id": 3,
      "name": "card"
    }
  ],
  "rides": [
    {
      "id": 14,
      "driver_id": 3,
      "bus_id": 10,
      "destination_id": 7,
      "time_id": 9,
      "status": "ended",
      "started_at": "2026-04-13 16:12:27",
      "ended_at": "2026-04-13 16:12:34",
      "trip_date": "2026-04-13",
      "last_map_coords": null
    },
    {
      "id": 15,
      "driver_id": 3,
      "bus_id": 10,
      "destination_id": 7,
      "time_id": 9,
      "status": "cancelled",
      "started_at": "2026-04-13 16:13:49",
      "ended_at": null,
      "trip_date": "2026-04-13",
      "last_map_coords": null
    },
    {
      "id": 16,
      "driver_id": 3,
      "bus_id": 10,
      "destination_id": 7,
      "time_id": 9,
      "status": "ended",
      "started_at": "2026-04-13 16:15:09",
      "ended_at": "2026-04-13 16:15:13",
      "trip_date": "2026-04-13",
      "last_map_coords": null
    },
    {
      "id": 17,
      "driver_id": 3,
      "bus_id": 10,
      "destination_id": 7,
      "time_id": 9,
      "status": "cancelled",
      "started_at": "2026-04-13 16:15:23",
      "ended_at": null,
      "trip_date": "2026-04-13",
      "last_map_coords": null
    },
    {
      "id": 18,
      "driver_id": 3,
      "bus_id": 10,
      "destination_id": 7,
      "time_id": 9,
      "status": "ended",
      "started_at": "2026-04-13 22:23:34",
      "ended_at": "2026-04-13 22:52:15",
      "trip_date": "2026-04-14",
      "last_map_coords": "23.773184,90.390528"
    },
    {
      "id": 19,
      "driver_id": 7,
      "bus_id": 10,
      "destination_id": 7,
      "time_id": 9,
      "status": "ended",
      "started_at": "2026-04-13 22:51:47",
      "ended_at": "2026-04-13 22:55:05",
      "trip_date": "2026-04-14",
      "last_map_coords": "23.773184,90.390528"
    },
    {
      "id": 20,
      "driver_id": 3,
      "bus_id": 10,
      "destination_id": 7,
      "time_id": 9,
      "status": "cancelled",
      "started_at": "2026-04-15 05:24:28",
      "ended_at": null,
      "trip_date": "2026-04-15",
      "last_map_coords": "23.773184,90.390528"
    }
  ],
  "tickets": [
    {
      "id": 14,
      "student_id": 2,
      "destination_id": 6,
      "time_id": 8,
      "bus_id": 10,
      "seats": 1,
      "female_only": 0,
      "payment_method": "online",
      "payment_status": "paid",
      "created_at": "2026-04-13 13:28:48",
      "trip_date": "2026-04-13"
    },
    {
      "id": 15,
      "student_id": 2,
      "destination_id": 7,
      "time_id": 9,
      "bus_id": 10,
      "seats": 1,
      "female_only": 0,
      "payment_method": "cash",
      "payment_status": "pending",
      "created_at": "2026-04-13 16:51:18",
      "trip_date": "2026-04-13"
    },
    {
      "id": 16,
      "student_id": 2,
      "destination_id": 7,
      "time_id": 9,
      "bus_id": 10,
      "seats": 1,
      "female_only": 0,
      "payment_method": "online",
      "payment_status": "paid",
      "created_at": "2026-04-13 16:51:52",
      "trip_date": "2026-04-13"
    }
  ],
  "users": [
    {
      "id": 1,
      "first_name": "Admin",
      "last_name": "User",
      "student_id": null,
      "email": "admin@example.com",
      "phone": "01612345678",
      "gender": null,
      "password": "$2y$10$XQYS1shjAokIMfgTgus0EezJaLH5tl1z9zr6Fny1jqQ81eMhXielq",
      "role": "admin",
      "created_at": "2026-04-12 18:30:55",
      "driving_license": null,
      "nid": null,
      "years_of_experience": null
    },
    {
      "id": 2,
      "first_name": "Amrita",
      "last_name": "Biswas",
      "student_id": "2022015642",
      "email": "amrita.biswas@northsouth.edu",
      "phone": "01812345678",
      "gender": "female",
      "password": "$2y$10$0A.Pba1MgzN4oF8qJ7z1BekoQiOgVyhvFf16H4aNLKuyjuE.QFlXO",
      "role": "student",
      "created_at": "2026-04-12 18:34:22",
      "driving_license": null,
      "nid": null,
      "years_of_experience": null
    },
    {
      "id": 3,
      "first_name": "Driver",
      "last_name": "One",
      "student_id": null,
      "email": "driver.one@example.com",
      "phone": "01712345678",
      "gender": null,
      "password": "$2y$10$4g9WZ8XIEjj3uDvS9nRLMuoJcbLrSQL8P80uuOAW5AkFvW5ubTfdy",
      "role": "driver",
      "created_at": "2026-04-12 18:38:42",
      "driving_license": "12981028192818219",
      "nid": "192802980132i32",
      "years_of_experience": 3
    },
    {
      "id": 4,
      "first_name": "User",
      "last_name": "One",
      "student_id": "2221234630",
      "email": "user.one@northsouth.edu",
      "phone": "01912345678",
      "gender": "male",
      "password": "$2y$10$Zo8TGTZAJwCbRM/XtIJJL.co/Zpeg1zPdkwVLMyFSn48rcMFSI4R.",
      "role": "student",
      "created_at": "2026-04-12 18:40:23",
      "driving_license": null,
      "nid": null,
      "years_of_experience": null
    },
    {
      "id": 5,
      "first_name": "Arka",
      "last_name": "Karmoker",
      "student_id": "2112343042",
      "email": "arka.karmoker@northsouth.edu",
      "phone": "01590153299",
      "gender": "male",
      "password": "$2y$10$PSWhTNK4LqQoeXoiUMgJS.BcQn8FhOhjJZpQeLt4DjA7o8o772OQS",
      "role": "student",
      "created_at": "2026-04-12 22:01:01",
      "driving_license": null,
      "nid": null,
      "years_of_experience": null
    },
    {
      "id": 7,
      "first_name": "Driver",
      "last_name": "Two",
      "student_id": null,
      "email": "driver.two@example.com",
      "phone": "01311234567",
      "gender": "male",
      "password": "$2y$10$B8fQN7Q/sSzhcdM7V1oMt.nNyOpU7YqW7KpLzihQ1Ors1owcAa19.",
      "role": "driver",
      "created_at": "2026-04-13 22:51:09",
      "driving_license": "982039828392032983",
      "nid": "293820983289",
      "years_of_experience": 2
    }
  ]
};

if (!localStorage.getItem('nsutms_db')) {
  localStorage.setItem('nsutms_db', JSON.stringify(initialState));
}

const db = JSON.parse(localStorage.getItem('nsutms_db'));

// Auto-inject 5 demo tickets for every student user
let updated = false;
let startTicketId = 200;

const studentUsers = db.users.filter(u => u.role === 'student');

studentUsers.forEach(student => {
    // Check if we already injected tickets for this student to avoid duplicates
    const studentTickets = db.tickets.filter(t => t.student_id === student.id && t.id >= 200);
    
    if (studentTickets.length < 5) {
        for (let i = 0; i < 5; i++) {
            const dest_id = [6, 8, 12, 10, 15, 20][i % 6]; 
            const time_id = [8, 10, 14, 12, 17, 22][i % 6]; 
            const bus_id = [10, 11, 12][i % 3];
            
            db.tickets.unshift({
                "id": startTicketId++,
                "student_id": student.id,
                "destination_id": dest_id,
                "time_id": time_id,
                "bus_id": bus_id,
                "seats": (i % 2 === 0) ? 1 : 2,
                "female_only": 0,
                "payment_method": (i % 2 === 0) ? "online" : "cash",
                "payment_status": (i % 3 === 0) ? "pending" : "paid",
                "created_at": `2026-04-16 1${i}:00:00`,
                "trip_date": `2026-04-${18 + i}`
            });
            updated = true;
        }
    }
});

// Auto-inject a few Active Live Rides for Track Buses demo
const demoRides = [
    {
        "id": 901,
        "driver_id": 3,
        "bus_id": 10,
        "destination_id": 6,
        "time_id": 8,
        "assignment_id": 12,
        "status": "started",
        "started_at": new Date().toISOString(),
        "ended_at": null,
        "trip_date": new Date().toISOString().split('T')[0],
        "last_map_coords": "23.8105,90.4125"
    },
    {
        "id": 902,
        "driver_id": 7,
        "bus_id": 11,
        "destination_id": 11,
        "time_id": 13,
        "assignment_id": 17,
        "status": "started",
        "started_at": new Date(Date.now() - 3600000).toISOString(),
        "ended_at": null,
        "trip_date": new Date().toISOString().split('T')[0],
        "last_map_coords": "23.7925,90.4078"
    }
];

demoRides.forEach(dr => {
    if (!db.rides.find(r => r.id === dr.id)) {
        db.rides.unshift(dr);
        updated = true;
    }
});

if (updated) {
    localStorage.setItem('nsutms_db', JSON.stringify(db));
}

function saveDB() {
  localStorage.setItem('nsutms_db', JSON.stringify(db));
}
