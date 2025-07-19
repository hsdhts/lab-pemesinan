flowchart TB
    %% Styling
    classDef default fill:#f9f9f9,stroke:#333,stroke-width:2px
    classDef decision fill:#e1f3d8,stroke:#333,stroke-width:2px
    classDef process fill:#fff,stroke:#333,stroke-width:2px
    classDef start fill:#d4edda,stroke:#333,stroke-width:2px
    classDef end fill:#f8d7da,stroke:#333,stroke-width:2px

    %% A. Operasi Awal
    subgraph "A. Operasi Awal"
        direction TB
        A1["Start: Pintu D terbuka"]:::start --> A2["SFB Konveyor 1 mengisi\nHopper X & X1"]:::process
        A2 --> A3{"Hopper X & X1\nHampir Penuh?"}:::decision
        A3 -->|Ya| A4["Pintu D tertutup"]:::process
        A4 --> A5["Buah dialihkan ke\nHopper Y & Y1"]:::process
        A5 --> A6["Rotary Feeder R & R1\naktif"]:::process
        A6 --> A7{"Hopper X & X1\nKosong?"}:::decision
        A7 -->|Tidak| A6
        A7 -->|Ya| A8["Rotary Feeder R & R1\nberhenti"]:::process
    end

    %% B. Operasi Kontinu
    subgraph "B. Operasi Kontinu"
        direction TB
        B1["Rotary Feeder P & P1\naktif"]:::process --> B2{"Hopper Y & Y1\nPenuh?"}:::decision
        B2 -->|Ya| B3["Pintu D terbuka"]:::process
        B3 --> B4["Mengisi Hopper\nX & X1"]:::process
        B4 --> B5{"Hopper Y & Y1\nKosong?"}:::decision
        B5 -->|Tidak| B2
        B5 -->|Ya| B6["Rotary Feeder P & P1\nberhenti"]:::process
    end

    %% C. Digester Penuh
    subgraph "C. Digester Penuh"
        direction TB
        C1{"Digester\nPenuh?"}:::decision -->|Ya| C2["Stop Rotary\nFeeder"]:::process
        C2 --> C3["Kurangi kecepatan\nSFB Konveyor 2"]:::process
        C3 --> C4{"Overflow\nSelesai?"}:::decision
        C4 -->|Ya| C5["Kembalikan\nkecepatan normal"]:::process
        C5 --> C6["Lanjutkan operasi\nRotary Feeder"]:::process
    end

    %% D. Emergency Stop
    subgraph "D. Emergency Stop"
        direction TB
        D1{"Emergency\nSwitch?"}:::decision -->|Ya| D2["Stop SFB\nKonveyor 2"]:::process
        D2 --> D3["Stop Rotary\nFeeder"]:::process
        D3 --> D4["Isi hopper\nsampai penuh"]:::process
        D4 --> D5["Stop SFB\nKonveyor 1"]:::process
        D5 --> D6{"Line Proses\nNormal?"}:::decision
    end

    %% E. Keterlambatan Buah
    subgraph "E. Keterlambatan Buah"
        direction TB
        E1["Operasi normal sampai\nhopper kosong"]:::process --> E2{"Sterilisasi\nNormal?"}:::decision
    end

    %% F. Selesai Proses
    subgraph "F. Selesai Proses"
        direction TB
        F1["End: Sama dengan\nketerlambatan buah"]:::end
    end

    %% Hubungan antar subgraf
    A8 --> B1
    B6 --> A1
    D6 -->|Ya| A6
    E2 -->|Ya| A1
    C6 --> B1
    C6 --> A6
